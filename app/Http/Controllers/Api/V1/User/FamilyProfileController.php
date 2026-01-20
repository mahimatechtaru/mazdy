<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FamilyProfile;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Response;
use Illuminate\Support\Facades\Auth;

class FamilyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $FamilyProfile = FamilyProfile::where('user_id', auth()->id())->get();
        return Response::success([__('FamilyProfile get Successfully.')], $FamilyProfile);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required|string|max:255',
            'relationship'      => 'required|string|max:100',
            'date_of_birth'     => 'nullable|date',
            'gender'            => 'nullable|in:male,female,other',
            'medical_history'   => 'nullable|string',
        ]);

        if ($validator->fails()) return Response::error($validator->errors()->all(), []);
        $validated = $validator->validate();
        try {
            $validated['user_id']      = auth()->id();
            $FamilyProfile = FamilyProfile::create($validated);
        } catch (Exception $e) {
            return Response::error([__('Something went wrong! Please try again.')]);
        }
        return Response::success([__('FamilyProfile Created Successfully.')], $FamilyProfile);
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
