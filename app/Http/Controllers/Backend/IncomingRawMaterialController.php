<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\IncomingRawMaterials;
use Illuminate\Http\Request;
use App\Http\Requests\IncomingRawMaterialRequest;
use App\Http\Services\RawMaterialService;
use App\Http\Services\IncomingRawMaterialService;

class IncomingRawMaterialController extends Controller
{
    public function __construct(
        private IncomingRawMaterialService $incomingRawMaterialService,
        private RawMaterialService $rawMaterialService,
        )
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.incoming-raw-material.index', [
            'incomingRawMaterials' => $this->incomingRawMaterialService->select(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.incoming-raw-material.create', [
            'materials' => $this->rawMaterialService->select()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IncomingRawMaterialRequest $request)
    {
        $data = $request->validated();

        try {
            // Simpan data ke incoming_raw_materials
            $incomingMaterial = IncomingRawMaterials::create($data);

            // Update unit di raw_materials
            $this->incomingRawMaterialService->updateRawMaterialUnit(
                $incomingMaterial->material_id,
                $incomingMaterial->unit,
                'add'
            );

            return redirect()->route('panel.incoming-raw-material.index')
                ->with('success', 'Data bahan baku masuk berhasil disimpan dan stok diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomingRawMaterials $incomingRawMaterials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $uuid)
    {
        return view('backend.incoming-raw-material.edit', [
            'incomingRawMaterial' => $this->incomingRawMaterialService->selectFirstBy('uuid', $uuid),
            'materials' => $this->rawMaterialService->select()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IncomingRawMaterialRequest $request, string $uuid)
    {
        $data = $request->validated();

        try {
            // Mengambil data IncomingRawMaterials berdasarkan UUID
            $incomingRawMaterial = $this->incomingRawMaterialService->selectFirstBy('uuid', $uuid);

            // Update data IncomingRawMaterials
            $oldUnit = $incomingRawMaterial->unit;
            $newUnit = $data['unit'];
            $incomingRawMaterial->update($data);

            // Jika ada perubahan pada material_id dan unit, update raw material
            if ($oldUnit !== $newUnit) {
                // Update unit raw material
                $difference = $newUnit - $oldUnit;

                if ($difference !== 0) {
                    // Tentukan apakah menambah atau mengurangi
                    $operation = $difference > 0 ? 'add' : 'subtract'; // Tentukan operasi berdasarkan selisih unit

                    // Update unit raw_material
                    $this->rawMaterialService->updateRawMaterialUnit(
                        $data['material_id'],
                        abs($difference), // Ambil nilai absolut dari perubahan
                        $operation
                    );
                }
            }

            if ($newUnit == 0) {
                // Tangani pengurangan unit pada raw_material
                $this->rawMaterialService->updateRawMaterialUnit(
                    $data['material_id'],
                    $oldUnit,
                    'subtract'
                );
            }

            return redirect()->route('panel.incoming-raw-material.index')
                ->with('success', 'Data bahan baku masuk berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        // Ambil data incoming raw material berdasarkan UUID
        $incomingRawMaterial = $this->incomingRawMaterialService->selectFirstBy('uuid', $uuid);

        // Ambil unit yang terkait dengan incoming raw material
        $unitToDelete = $incomingRawMaterial->unit;
        $materialId = $incomingRawMaterial->material_id;

        // Hapus data incoming raw material
        $incomingRawMaterial->delete();

        // Kurangi unit pada raw_material sesuai dengan unit yang dihapus
        $this->rawMaterialService->updateRawMaterialUnit(
            $materialId,
            $unitToDelete,
            'subtract'
        );

        return response()->json([
            'message' => 'Data bahan baku masuk berhasil dihapus'
        ]);
    }
}
