<?php
namespace App\Http\Services;

use App\Models\IncomingRawMaterials;

class IncomingRawMaterialService
{
    public function select($paginate = null)
    {
        if ($paginate) {
            return IncomingRawMaterials::with('material:id,name')->latest()->select('id', 'uuid', 'material_id', 'tanggal_pembelian', 'unit')->paginate($paginate);
        }

        return IncomingRawMaterials::latest()->get();
    }

    public function selectFirstBy($column, $value)
    {
        return IncomingRawMaterials::with('material:id,name')->where($column, $value)->firstOrFail();
    }

    public function updateRawMaterialUnit($materialId, $unit)
    {
        $rawMaterial = \App\Models\RawMaterial::find($materialId);

        if (!$rawMaterial) {
            throw new \RuntimeException("Material dengan ID {$materialId} tidak ditemukan.");
        }

        $rawMaterial->unit += $unit;
        $rawMaterial->save();

        return $rawMaterial;
    }

    public function updatRawMaterialUnit($materialId, $unit)
    {
        $rawMaterial = \App\Models\RawMaterial::find($materialId);

        if (!$rawMaterial) {
            throw new \RuntimeException("Material dengan ID {$materialId} tidak ditemukan.");
        }

        $rawMaterial->unit -= $unit;
        $rawMaterial->save();

        return $rawMaterial;
    }

}
