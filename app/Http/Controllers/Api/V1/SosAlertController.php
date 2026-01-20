<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SosAlert;
use App\Models\AssinedProvider;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Response;
use Illuminate\Support\Facades\Auth;

class SosAlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $SosAlert = SosAlert::where('user_id', auth()->id())->get();
        return Response::success([__('SosAlert get Successfully.')], $SosAlert);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'location_address' => 'nullable|string',
            'emergency_details' => 'nullable|string',
        ]);

        if ($validator->fails()) return Response::error($validator->errors()->all(), []);
        $validated = $validator->validate();
        try {
            $AssinedProvider = AssinedProvider::where("user_id",auth()->id())->where('status','Active')->first();
        
            $sos = SosAlert::create([
                'user_id' => auth()->id(),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'location_address' => $request->location_address,
                'emergency_details' => $request->emergency_details,
                'ambulance_id' => $AssinedProvider->ambulance_id ?? null,
                'doctor_id' => $AssinedProvider->doctor_id ?? null,
                'status' => 'active',
            ]);
        } catch (Exception $e) {
            return Response::error([__('Something went wrong! Please try again.')]);
        }
        return Response::success([__('SOS alert has been sent successfully.')], $sos);
    }
    public function resolve($id)
    {
        $sos = SosAlert::where('user_id', auth()->id())->findOrFail($id);
        $sos->update(['status' => 'resolved']);
        return Response::success([__('SOS alert has been sent successfully.')], []);
    }
    public function showActive()
    {
        $sos = SosAlert::with(['user', 'doctor', 'ambulance'])
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->latest()
            ->first();
    
        if (!$sos) {
            return Response::error([__('No active SOS found.')]);
        }
        $data =  [
                'latitude' => $sos->latitude,
                'longitude' => $sos->longitude,
                'location_address' => $sos->location_address,
                'message' => 'SOS Alert Sent! Help is on the way.',
                'eta' => $sos->eta ?? 'Not available',
                'doctor' => optional($sos->doctor)->only(['id', 'firstname', 'mobile']),
                'ambulance' => optional($sos->ambulance)->only(['id', 'firstname', 'mobile']),
                'emergency_contacts' => $sos->user->familyProfiles()->get(['name', 'relationship', 'medical_history']),
            ];
        return Response::success([__('SOS alert has been sent successfully.')], $data);
    
    }
    public function cancel($id)
    {
        $sos = SosAlert::where('user_id', auth()->id())->findOrFail($id);
    
        if ($sos->status !== 'active') {
            return Response::error([__('SOS already resolved or canceled.')]);
        }
    
        $sos->update(['status' => 'resolved']);
    
        // Optionally notify responders that the SOS was canceled
        return Response::success([__('SOS alert canceled successfully.')], []);
   
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
