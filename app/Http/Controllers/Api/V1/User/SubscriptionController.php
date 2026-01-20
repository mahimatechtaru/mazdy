<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class SubscriptionController extends Controller
{
    //
    public function index()
    {
        $Subscription = Subscription::where('user_id', auth()->id())->with('package')->latest()->get();
        return Response::success([__('Subscription get Successfully.')], $Subscription);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:packages,id',
            'payment_method' => 'required|string',
        ]);
        
      
        if ($validator->fails()) return Response::error($validator->errors()->all(), []);
        $validated = $validator->validate();
        $package = Package::find($request->package_id);
        if(!$package){
             return Response::error([__('Something went wrong! Please try again.')]);
        }

        $duration = match(strtolower($package->plan_type)) {
            'daily' => 1,
            'weekly' => 7,
            'monthly' => 30,
            default => 30,
        };
        try {
            $validated['user_id']      = auth()->id();
            $validated['amount']  =  $package->price;
            $validated['payment_status']  =  'paid';
            $validated['status']  =  'active';
            $validated['start_date']  =  Carbon::now();
            $validated['end_date']  =  Carbon::now()->addDays($duration);
            $validated['transaction_id']  =  'TXN' . time();
    
            
            $FamilyProfile = Subscription::create($validated);
        } catch (Exception $e) {
            return Response::error([__('Something went wrong! Please try again.')]);
        }
        return Response::success([__('Subscription Created Successfully.')], $FamilyProfile);
    }
}
