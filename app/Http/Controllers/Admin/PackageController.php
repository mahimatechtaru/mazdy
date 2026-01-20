<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; 
use Str;

class PackageController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = __("Package Manager");
        $service = Package::get();
        // dd($categories);
        return view('admin.sections.package.index',compact(
            'page_title',
            'service'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'plan_type' => 'required|string',
            'duration' => 'nullable|string',
            'badge' => 'nullable|string',
            'target_audience' => 'nullable|string',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'faqs' => 'nullable|string',
            'terms' => 'nullable|string',
            'cancellation_policy' => 'nullable|string',
            'is_active' => 'nullable|string',
        ]);
        
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with("modal", "language-add");
        }
    
        $validated = $validator->validated();
    
        try {
            
            $validated['slug'] = Str::slug($request->name);
            Package::create($validated);
    
        } catch (Exception $e) {
            return back()->with(['error' => [__('Something went wrong! Please try again.')]]);
        }
    
        return back()->with(['success' => [__('Package created successfully!')]]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    
      public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'plan_type' => 'required|string',
            'duration' => 'nullable|string',
            'badge' => 'nullable|string',
            'target_audience' => 'nullable|string',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'faqs' => 'nullable|string',
            'terms' => 'nullable|string',
            'cancellation_policy' => 'nullable|string',
            'is_active' => 'nullable|string',
        ]);
        
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with("modal", "language-edit");
        }
    
        $validated = $validator->validated();
    
        $service = Package::findOrFail($request->target);
    
        try {
            
    
            $service->update($validated);
    
        } catch (Exception $e) {
            return back()->with(['error' => [__('Something went wrong! Please try again')]]);
        }
    
        return back()->with(['success' => [__('Package updated successfully!')]]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
