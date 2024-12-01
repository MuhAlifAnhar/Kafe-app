<?php

namespace App\Http\Services\Backend;

use App\Models\Backend\ForecastingResult;
use App\Models\Backend\RawMaterial;
use App\Models\Backend\RawMaterialUsage;
use Illuminate\Support\Facades\DB;

class ForecastingService
{
    public function getRecentForecasts($limit = 10)
    {
        return ForecastingResult::with(['rawMaterial.category'])
            ->latest('date')
            ->limit($limit)
            ->get();
    }

    public function getForecastHistory($paginate = null, $rawMaterialId = null, $dateFrom = null, $dateTo = null)
    {
        $query = ForecastingResult::with(['rawMaterial.category'])
            ->when($rawMaterialId, function ($q) use ($rawMaterialId) {
                return $q->where('raw_material_id', $rawMaterialId);
            })
            ->when($dateFrom, function ($q) use ($dateFrom) {
                return $q->whereDate('date', '>=', $dateFrom);
            })
            ->when($dateTo, function ($q) use ($dateTo) {
                return $q->whereDate('date', '<=', $dateTo);
            })
            ->latest('date');

        return $paginate ? $query->paginate($paginate) : $query->get();
    }

    public function generateForecast($rawMaterialId, $period = 3)
    {
        DB::beginTransaction();
        try {
            $rawMaterial = RawMaterial::findOrFail($rawMaterialId);

            if ($rawMaterial->stock <= 0) {
                throw new \Exception('Cannot forecast for material with no stock.');
            }

            // Ambil total penggunaan per bulan sesuai period yang diminta
            $monthlyUsages = RawMaterialUsage::where('raw_material_id', $rawMaterialId)
                ->whereDate('date', '>=', now()->subMonths($period))
                ->select(
                    DB::raw('YEAR(date) as year'),
                    DB::raw('MONTH(date) as month'),
                    DB::raw('SUM(quantity_used) as total_usage')
                )
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->take($period)
                ->get();

            if ($monthlyUsages->count() < $period) {
                throw new \Exception("Tidak cukup data untuk peramalan. Dibutuhkan data penggunaan material minimal {$period} bulan terakhir.");
            }

            // Generate bobot berdasarkan period
            $weights = array_reverse(range(1, $period));
            $totalWeight = array_sum($weights);

            // Hitung WMA
            $weightedSum = 0;
            foreach ($monthlyUsages as $index => $usage) {
                $weightedSum += $usage->total_usage * $weights[$index];
            }

            // Hasil prediksi
            $predictedAmount = $weightedSum / $totalWeight;

            // Ambil data bulan terakhir untuk actual_usage
            $actualUsage = $monthlyUsages->first()->total_usage;

            // Hitung error rate
            $errorRate = abs(($actualUsage - $predictedAmount) / $actualUsage) * 100;

            // Simpan hasil forecast
            ForecastingResult::create([
                'raw_material_id' => $rawMaterialId,
                'date' => now()->addMonth()->startOfMonth(),
                'predicted_amount' => $predictedAmount,
                'forecasting_method' => "Weighted Moving Average ({$period} months)",
                'actual_usage' => $actualUsage,
                'error_rate' => $errorRate,
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function getAccuracyAnalysis($rawMaterialId, $dateFrom = null, $dateTo = null)
    {
        $forecasts = ForecastingResult::where('raw_material_id', $rawMaterialId)
            ->when($dateFrom, function ($q) use ($dateFrom) {
                return $q->whereDate('date', '>=', $dateFrom);
            })
            ->when($dateTo, function ($q) use ($dateTo) {
                return $q->whereDate('date', '<=', $dateTo);
            })
            ->get();

        if ($forecasts->isEmpty()) {
            return null;
        }

        return [
            'total_forecasts' => $forecasts->count(),
            'average_error' => round($forecasts->avg('error_rate'), 1),
            'min_error' => round($forecasts->min('error_rate'), 1),
            'max_error' => round($forecasts->max('error_rate'), 1),
            'accuracy_trend' => $forecasts->map(function ($f) {
                return [
                    'date' => $f->date->format('d M Y'),
                    'error_rate' => round($f->error_rate, 1),
                    'actual' => round($f->actual_usage, 1),
                    'forecast' => round($f->predicted_amount, 1),
                ];
            })->values(),
        ];
    }
}
