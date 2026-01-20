<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Models\Admin\BasicSettings;
use App\Models\SosAlert;
use App\Models\User;
use Exception; 

class SosLogController extends Controller
{
    /* Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = __("All Logs");
        $transactions = SosAlert::
        with(
            'user:id,firstname,email,username,mobile',
            'doctor:id,firstname,email,username,mobile',
            'ambulance:id,firstname,email,username,mobile'
           
        )
        ->latest()
        ->paginate(20);

        return view('admin.sections.sos-log.index', compact(
            'page_title',
            'transactions'
        ));
    }


    /**
     * Pending sos-log Logs View.
     * @return view $pending-sos-log-logs
     */
    public function pending()
    {
        $page_title = __("Pending Logs");
        $transactions = SosAlert::with(
            'user:id,firstname,email,username,mobile',
            'doctor:id,firstname,email,username,mobile',
            'ambulance:id,firstname,email,username,mobile'
           
        )
        ->latest()
        ->where('status', 'active')->paginate(20);
        return view('admin.sections.sos-log.index', compact(
            'page_title',
            'transactions'
        ));
    }

    /**
     * Complete sos-log Logs View.
     * @return view $complete-sos-log-logs
     */
    public function complete()
    {
        $page_title = __("Complete Logs");
        $transactions = SosAlert::with(
            'user:id,firstname,email,username,mobile',
            'doctor:id,firstname,email,username,mobile',
            'ambulance:id,firstname,email,username,mobile'
           
        )
        ->latest()
        ->where('status', 'resolved')->paginate(20);
        return view('admin.sections.sos-log.index', compact(
            'page_title',
            'transactions'
        ));
    }

    /**
     * Canceled sos-log Logs View.
     * @return view $canceled-sos-log-logs
     */
    public function canceled()
    {
        $page_title = __("Canceled Logs");
        $transactions = SosAlert::with(
            'user:id,firstname,email,username,mobile',
            'doctor:id,firstname,email,username,mobile',
            'ambulance:id,firstname,email,username,mobile'
           
        )
        ->latest()
        ->where('status', 3)->paginate(20);
        return view('admin.sections.sos-log.index', compact(
            'page_title',
            'transactions'
        ));
    }

     /**
     * Method for booking log details
     * @param $trx_id
     * @param \Illuminate\Http\Request $request
     */
    public function details(Request $request,$trx_id){
        $page_title     = "Booking Details";
        $data           = SosAlert::with(['doctor','schedule','payment_gateway'])->where('trx_id',$trx_id)->first();
        if(!$data) return back()->with(['error' => ['Data Not Found!']]);

        return view('admin.sections.sos-log.details',compact(
            'page_title',
            'data',
        ));
    }

       /**
     * Method for update Status for Booking Logs
     * @param $trx_id
     * @param \Illuminate\Http\Request $request
     */
    public function statusUpdate(Request $request){
        $validator      = Validator::make($request->all(),[
            'status'    => 'required|integer',
            'trxId'     =>  'required'
        ]);
        $data           = SosAlert::with(['doctor','schedule','payment_gateway'])->where('trx_id',$request->trxId)->first();
        if(!$data) return back()->with(['error' =>  ['Data Not Found!']]);

        if($validator->fails()){
            return Response::error(['error' => $validator->errors()]);
        }
        $validated = $validator->validate();
        $basic_setting = BasicSettings::first();
        try{
            $data->update([
                'status'    => $validated['status'],
            ]);
            $user   = User::where('id',$data->user_id)->first();
            if($basic_setting->email_notification == true){
                try{
                    Notification::route("mail",$user->email)->notify(new EmailNotification($user,$data,$data->trx_id));
                }catch(Exception $e){
                }
            }
        }catch(Exception $e){
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }
        return back()->with(['success'  => ['Booking Status Updated Successfully.']]);

    }


}
