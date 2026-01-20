<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignedEquipment;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Response;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipments = AssignedEquipment::with('equipment')
        ->where('patient_id', auth()->id())
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->equipment->name,
                'model' => $item->equipment->model,
                'assigned_date' => $item->assigned_date,
                'status' => ucfirst($item->status),
            ];
        });
        return Response::success([__('Assigned Equipment get Successfully.')], $equipments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
