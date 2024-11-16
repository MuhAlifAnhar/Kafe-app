<?php
namespace App\Http\Services;

use App\Models\RawMaterial;

class RawMaterialService
{
    public function select($paginate = null)
    {
        if ($paginate) {
            return RawMaterial::latest()->select('id', 'uuid', 'name', 'unit')->paginate($paginate);
        }

        return RawMaterial::latest()->get();
    }

    public function selectFirstBy($column, $value)
    {
        return RawMaterial::where($column, $value)->firstOrFail();
    }

    // Di dalam RawMaterialService

    public function updateRawMaterialUnit($materialId, $unit, $operation = 'add')
    {
        $rawMaterial = RawMaterial::findOrFail($materialId);

        // Tentukan apakah menambah atau mengurangi unit
        if ($operation === 'add') {
            $rawMaterial->increment('unit', $unit); // Menambah unit
        } elseif ($operation === 'subtract') {
            // Mengurangi unit, pastikan unit tidak menjadi negatif
            if ($rawMaterial->unit - $unit >= 0) {
                $rawMaterial->decrement('unit', $unit); // Mengurangi unit
            } else {
                // Pastikan tidak mengurangi unit menjadi negatif
                $rawMaterial->unit = 0; // Set unit ke 0 jika pengurangan lebih besar dari unit saat ini
            }
        }

        $rawMaterial->save();
    }


}
