<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServicesCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; 
class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = __("Services Type Manager");
        $service = Service::with('ServicesCategory')->get();
        $categories  = ServicesCategory::all();
        // dd($categories);
        return view('admin.sections.services.index',compact(
            'page_title',
            'service','categories'
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
            'name'        => 'required|string|max:80',
            'description' => 'required|string',
            'category'    => 'required|exists:services_categories,id',
            'base_price'  => 'required|numeric|min:0',
            'icon'        => 'required|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with("modal", "language-add");
        }
    
        $validated = $validator->validated();
    
        try {
            if ($request->hasFile('icon')) {
                $icon = $request->file('icon');
                $iconName = time() . '_' . $icon->getClientOriginalName();
                $icon->move(public_path('frontend/images/site-section'), $iconName);
                $validated['icon'] = 'frontend/images/site-section/' . $iconName;
            }
    
            Service::create($validated);
    
        } catch (Exception $e) {
            return back()->with(['error' => [__('Something went wrong! Please try again.')]]);
        }
    
        return back()->with(['success' => [__('Service created successfully!')]]);
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
            'name'        => 'required|string|max:80',
            'description' => 'required|string',
            'category'    => 'required|exists:services_categories,id',
            'base_price'  => 'required|numeric|min:0',
            'icon'        => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with("modal", "language-edit");
        }
    
        $validated = $validator->validated();
    
        $service = Service::findOrFail($request->target);
    
        try {
            if ($request->hasFile('icon')) {
                // Delete old icon if exists
                if ($service->icon && file_exists(public_path($service->icon))) {
                    unlink(public_path($service->icon));
                }
    
                $icon = $request->file('icon');
                $iconName = time() . '_' . $icon->getClientOriginalName();
                $icon->move(public_path('frontend/images/site-section'), $iconName);
                $validated['icon'] = 'frontend/images/site-section/' . $iconName;
            }
    
            $service->update($validated);
    
        } catch (Exception $e) {
            return back()->with(['error' => [__('Something went wrong! Please try again')]]);
        }
    
        return back()->with(['success' => [__('Service updated successfully!')]]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
