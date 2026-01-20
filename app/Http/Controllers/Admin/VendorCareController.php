<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Constants\GlobalConst;
use App\Http\Helpers\Response;
use App\Models\UserSupportTicket;
use Illuminate\Support\Facades\DB;
use App\Constants\NotificationConst;
use App\Models\Hospital\HospitalMailLog;
use App\Notifications\User\SendMail;
use Illuminate\Support\Facades\Auth;
use App\Constants\SupportTicketConst;
use App\Models\Hospital\HospitalLoginLog;
use App\Constants\PaymentGatewayConst;
use App\Events\Admin\NotificationEvent;
use App\Models\Hospital\HospitalNotification;
use App\Models\Hospital\HospitalWallet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Jenssegers\Agent\Agent;
class VendorCareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = __("All Vendors");
        $users = User::where('role','vendor')->orderBy('id', 'desc')->paginate(12);
        return view('admin.sections.vendor-care.index', compact(
            'page_title',
            'users'
        ));
    }

    /**
     * Display Active Users
     * @return view
     */
    public function active()
    {
        $page_title = __("Active Vendors");
        $users = User::active()->where('role','vendor')->with('vendor')->orderBy('id', 'desc')->paginate(12);
        // dd($users);
        return view('admin.sections.vendor-care.index', compact(
            'page_title',
            'users'
        ));
    }


    /**
     * Display Banned Users
     * @return view
     */
    public function banned()
    {
        $page_title = __("Banned Vendors");
        $users = User::banned()->where('role','vendor')->orderBy('id', 'desc')->paginate(12);
        return view('admin.sections.vendor-care.index', compact(
            'page_title',
            'users'
        ));
    }

    /**
     * Display Email Unverified Users
     * @return view
     */
    public function emailUnverified()
    {
        $page_title = __("Email Unverified Vendors");
        $users = User::active()->where('role','vendor')->orderBy('id', 'desc')->emailUnverified()->paginate(12);
        return view('admin.sections.vendor-care.index', compact(
            'page_title',
            'users'
        ));
    }

    /**
     * Display SMS Unverified Users
     * @return view
     */
    public function SmsUnverified()
    {
        $page_title = __("SMS Unverified Vendors");
        return view('admin.sections.vendor-care.index', compact(
            'page_title'
        ));
    }

    /**
     * Display KYC Unverified Users
     * @return view
     */
    public function KycUnverified()
    {
        $page_title = __("KYC Unverified Vendors");
        $users = User::kycUnverified()->where('role','vendor')->orderBy('id', 'desc')->paginate(8);
        return view('admin.sections.vendor-care.index', compact(
            'page_title',
            'users'
        ));
    }

    /**
     * Display Send Email to All Users View
     * @return view
     */
    public function emailAllVendors()
    {
        $page_title = __("Email To Vendors");
        return view('admin.sections.vendor-care.email-to-Vendors', compact(
            'page_title'
        ));
    }

    /**
     * Display Specific User Information
     * @return view
     */
    public function vendorDetails($username)
    {
        $page_title = __("Vendors Details");
        $users = User::where('role','vendor')->where('username', $username)->first();
        $support_ticket = UserSupportTicket::where("status",SupportTicketConst::PENDING)->orWhere("status",SupportTicketConst::DEFAULT)->Where('hospital_id', $users->id)->count('status');

        if(!$users) return back()->with(['error' => ['Opps! User not exists']]);
        return view('admin.sections.vendor-care.details', compact(
            'page_title',
            'users',
            'support_ticket'
        ));
    }

    public function sendMailVendors(Request $request) {
        $request->validate([
            'user_type'     => "required|string|max:30",
            'subject'       => "required|string|max:250",
            'message'       => "required|string|max:2000",
        ]);

        $users = [];
        switch($request->user_type) {
            case "active";
                $users = User::where('role','vendor')->active()->get();
                break;
            case "all";
                $users = User::where('role','vendor')->get();
                break;
            case "email_verified";
                $users = User::where('role','vendor')->emailVerified()->get();
                break;
            case "kyc_verified";
                $users = User::where('role','vendor')->kycVerified()->get();
                break;
            case "banned";
                $users = User::where('role','vendor')->banned()->get();
                break;
        }

        try{
            Notification::send($users,new SendMail((object) $request->all()));
        }catch(Exception $e) {
            return back()->with(['error' => [__('Something went wrong! Please try again')]]);
        }

        return back()->with(['success' => ['Email successfully sended']]);

    }

    public function sendMail(Request $request, $username)
    {
        $request->merge(['username' => $username]);
        $validator = Validator::make($request->all(),[
            'subject'       => 'required|string|max:200',
            'message'       => 'required|string|max:2000',
            'username'      => 'required|string|exists:users,username',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with("modal","email-send");
        }
        $validated = $validator->validate();
        $hospital = User::where('role','vendor')->where("username",$username)->first();
        $validated['hospital_id'] = $hospital->id;
        $validated = Arr::except($validated,['username']);
        $validated['method']   = "SMTP";
        try{
            HospitalMailLog::create($validated);
            $hospital->notify(new SendMail((object) $validated));
        }catch(Exception $e) {
            return back()->with(['error' => [__('Something went wrong! Please try again')]]);
        }
        return back()->with(['success' => ['Mail successfully sended']]);
    }

    public function userDetailsUpdate(Request $request, $username)
    {
        $request->merge(['username' => $username]);
  
        $validator = Validator::make($request->all(),[
            'username'              => "required|exists:users,username",
            'firstname'             => "required|string|max:60",
            'mobile_code'           => "nullable|string|max:10",
            'mobile'                => "nullable|string|max:20",
            'address'               => "nullable|string|max:250",
            'country'               => "nullable|string|max:50",
            'state'                 => "nullable|string|max:50",
            'city'                  => "nullable|string|max:50",
            'zip_code'              => "nullable|numeric|max_digits:8",
            'email_verified'        => 'required|boolean',
            'two_factor_verified'   => 'required|boolean',
            'kyc_verified'          => 'required|boolean',
            'status'                => 'required|boolean',
        ]);
        $validated = $validator->validate();
        $validated['address']  = [
            'country'       => $validated['country'] ?? "",
            'state'         => $validated['state'] ?? "",
            'city'          => $validated['city'] ?? "",
            'zip'           => $validated['zip_code'] ?? "",
            'address'       => $validated['address'] ?? "",
        ];
        $validated['mobile_code']       = remove_speacial_char($validated['mobile_code']);
        $validated['mobile']            = remove_speacial_char($validated['mobile']);
        $validated['full_mobile']       = $validated['mobile_code'] . $validated['mobile'];

        $user = User::where('role','vendor')->where('username', $username)->first();
        if(!$user) return back()->with(['error' => ['Opps! User not exists']]);

        try {
            $user->update($validated);
        } catch (Exception $e) {
            return back()->with(['error' => [__('Something went wrong! Please try again')]]);
        }

        return back()->with(['success' => [__('Profile Information Updated Successfully!')]]);
    }

    public function loginLogs($username)
    {
        $page_title = __("Login Logs");
        $user = User::where("username",$username)->first();
        if(!$user) return back()->with(['error' => ['Opps! User doesn\'t exists']]);
        $logs = HospitalLoginLog::where('hospital_id',$user->id)->paginate(12);
        return view('admin.sections.vendor-care.login-logs', compact(
            'logs',
            'page_title',
        ));
    }

    public function mailLogs($username) {
        $page_title = __("Hospital Email Logs");
        $hospital = User::where("username",$username)->first();
        if(!$hospital) return back()->with(['error' => ['Opps! User doesn\'t exists']]);
        $logs = HospitalMailLog::where("hospital_id",$hospital->id)->paginate(12);
        return view('admin.sections.vendor-care.mail-logs',compact(
            'page_title',
            'logs',
        ));
    }

    public function loginAsMember(Request $request,$username) {
        $request->merge(['username' => $username]);
        $request->validate([
            'target'            => 'required|string|exists:Vendors,username',
            'username'          => 'required_without:target|string|exists:Vendors',
        ]);

        try{
            $user = User::where("username",$request->username)->first();
            Auth::guard("hospital")->login($user);
        }catch(Exception $e) {
            return back()->with(['error' => [$e->getMessage()]]);
        }
        return redirect()->intended(route('Vendors.dashboard'));
    }

    public function kycDetails($username) {
        $users = User::with('kyc')->where("username",$username)->first();
        if(!$users) return back()->with(['error' => ['Opps! User doesn\'t exists']]);

        $page_title = __("KYC Profile");
        return view('admin.sections.vendor-care.kyc-details',compact("page_title","users"));
    }

    public function kycApprove(Request $request, $username) {
        $request->merge(['username' => $username]);
        $request->validate([
            'target'        => "required|exists:users,username",
            'username'      => "required_without:target|exists:users,username",
        ]);
        $user = User::where('username',$request->target)->orWhere('username',$request->username)->first();
        if($user->kyc_verified == GlobalConst::VERIFIED) return back()->with(['warning' => ['Hospital already KYC verified']]);
        if($user->kyc == null) return back()->with(['error' => ['User KYC information not found']]);

        try{
            $user->update([
                'kyc_verified'  => GlobalConst::APPROVED,
            ]);
        }catch(Exception $e) {
            $user->update([
                'kyc_verified'  => GlobalConst::PENDING,
            ]);
            return back()->with(['error' => [__('Something went wrong! Please try again')]]);
        }
        return back()->with(['success' => [__('Hospital KYC successfully approved')]]);
    }

    public function kycReject(Request $request, $username) {
        $request->validate([
            'target'        => "required|exists:users,username",
            'reason'        => "required|string|max:500"
        ]);
        $user = User::where("username",$request->target)->first();
        if(!$user) return back()->with(['error' => ['Hospital doesn\'t exists']]);
        if($user->kyc == null) return back()->with(['error' => [__('Hospital KYC information not found')]]);

        try{
            $user->update([
                'kyc_verified'  => GlobalConst::REJECTED,
            ]);
            $user->kyc->update([
                'reject_reason' => $request->reason,
            ]);
        }catch(Exception $e) {
            $user->update([
                'kyc_verified'  => GlobalConst::PENDING,
            ]);
            $user->kyc->update([
                'reject_reason' => null,
            ]);

            return back()->with(['error' => [__('Something went wrong! Please try again')]]);
        }

        return back()->with(['success' => [__('Hospital KYC information is rejected')]]);
    }


    public function search(Request $request) {
        $validator = Validator::make($request->all(),[
            'text'  => 'required|string',
        ]);

        if($validator->fails()) {
            $error = ['error' => $validator->errors()];
            return Response::error($error,null,400);
        }

        $validated = $validator->validate();
        $users = User::search($validated['text'])->limit(10)->get();
        return view('admin.components.search.user-search',compact(
            'users',
        ));
    }

    public function walletBalanceUpdate(Request $request,$username) {
        $validator = Validator::make($request->all(),[
            'type'      => "required|string|in:add,subtract",
            'wallet'    => "required|numeric|exists:hospital_wallets,id",
            'amount'    => "required|numeric",
            'remark'    => "required|string|max:200",
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('modal','wallet-balance-update-modal');
        }

        $validated = $validator->validate();
        $user_wallet = HospitalWallet::whereHas('hospital',function($q) use ($username){
            $q->where('username',$username);
        })->find($validated['wallet']);
        if(!$user_wallet) return back()->with(['error' => [__("Hospital wallet not found!")]]);
        DB::beginTransaction();
        try{

            $user_wallet_balance = 0;

            switch($validated['type']){
                case "add":
                    $type = "Added";
                    $user_wallet_balance = $user_wallet->balance + $validated['amount'];
                    $user_wallet->balance += $validated['amount'];
                    break;

                case "subtract":
                    $type = "Subtracted";
                    if($user_wallet->balance >= $validated['amount']) {
                        $user_wallet_balance = $user_wallet->balance - $validated['amount'];
                        $user_wallet->balance -= $validated['amount'];
                    }else {
                        return back()->with(['error' => [__("Hospital do not have sufficient balance")]]);
                    }
                    break;
            }

            $inserted_id = DB::table("transactions")->insertGetId([
                'user_id'           => $user_wallet->hospital->id,
                'wallet_id'         => $user_wallet->id,
                'type'              => PaymentGatewayConst::TYPEADDSUBTRACTBALANCE,
                'trx_id'            => generate_unique_string("transactions","trx_id",16),
                'request_amount'    => $validated['amount'],
                'total_charge'      => $validated['amount'],
                'available_balance' => $user_wallet_balance,
                'remark'            => $validated['remark'],
                'status'            => GlobalConst::SUCCESS,
                'request_currency'  => $user_wallet->currency->code,
                'created_at'                    => now(),
            ]);

            $client_ip = request()->ip() ?? false;
            $location = geoip()->getLocation($client_ip);
            $agent = new Agent();

            // $mac = exec('getmac');
            // $mac = explode(" ",$mac);
            // $mac = array_shift($mac);
            $mac = "";

            $user_wallet->save();
            DB::commit();
        }catch(Exception $e) {
            DB::rollBack();
            return back()->with(['error' => [__("Transaction Failed!")]]);
        }

        return back()->with(['success' => [__("Transaction success")]]);
    }

}
