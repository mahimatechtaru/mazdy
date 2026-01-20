<?php

namespace App\Http\Controllers\provider\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProviderAuthController extends Controller
{
    public function showLoginForm()
    {
        $page_title = setPageTitle("Provider Login");
        return view('frontend.providers.login', compact('page_title'));
    }

    public function showRegisterForm()
    {
        return view('frontend.providers.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nulable',
            'email' => 'required|email|unique:providers',
            'mobile' => 'nulable',
            'password' => 'required',
        ]);

        $provider = Provider::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('provider')->login($provider);

        return 'Work in progress....';
    }

    public function login(Request $request)
    {
        $request->validate([
            'credentials' => 'required',
            'password' => 'required',
        ]);

        $credentials = filter_var($request->credentials, FILTER_VALIDATE_EMAIL)
            ? ['email' => $request->credentials, 'password' => $request->password]
            : ['mobile' => $request->credentials, 'password' => $request->password];

        if (Auth::guard('provider')->attempt($credentials, $request->remember)) {
            return 'Work in progress....';
        }

        return back()->withErrors(['credentials' => 'Invalid credentials'])->withInput();
    }

    public function dashboard()
    {
        return view('frontend.providers.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('provider')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('providers.login')->with('success', 'Logged out successfully.');
    }
}
