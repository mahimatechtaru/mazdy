<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Vender\Auth\AuthController;
use App\Http\Controllers\Api\V1\Vender\Auth\AuthorizationController;
use App\Http\Controllers\Api\V1\Vender\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Vender\BookingRequestController;
use App\Http\Controllers\Api\V1\Vender\BranchController;
use App\Http\Controllers\Api\V1\Vender\ProfileController;
use App\Http\Controllers\Api\V1\Vender\DashboardController;
use App\Http\Controllers\Api\V1\Vender\DepartmentController;
use App\Http\Controllers\Api\V1\Vender\DoctorController;
use App\Http\Controllers\Api\V1\Vender\HealthPackageController;
use App\Http\Controllers\Api\V1\Vender\InvestigationController;
use App\Http\Controllers\Api\V1\Vender\ServiceRequestController;
use App\Http\Controllers\Api\V1\Vender\WithdrawController;

Route::name('api.v1.')->group(function () {

    // User
    Route::group(['prefix' => 'venders', 'as' => 'venders.'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthorizationController::class, 'logout']);
        // Vender Profile
        Route::controller(ProfileController::class)->prefix('profile')->group(function () {
                Route::get('/', 'profile');
                Route::post('update', 'profileUpdate')->middleware('app.mode');
                Route::post('delete', 'deleteAccount')->middleware('app.mode');
                Route::post('password/update', 'passwordUpdate')->middleware('app.mode');
    
            });
        
        Route::controller(AuthorizationController::class)->prefix('kyc')->group(function () {
            Route::get('input-fields', 'getKycInputFields');
            Route::post('submit', 'KycSubmit');
        });
        });
    });
    
});
