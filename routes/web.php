<?php

use App\Http\Controllers\Customer\Auth\CustomerLoginController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InsuranceCategoryController;
use App\Http\Controllers\InsuranceTypeController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\InsuranceRuleController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/users', UserController::class)->except(['show']);
    Route::resource('/insuranceCategory', InsuranceCategoryController::class)->except(['show']);
    Route::resource('/insuranceType', InsuranceTypeController::class)->except(['show']);
    Route::resource('/rule', RuleController::class)->except(['show']);
    Route::resource('/insuranceRule', InsuranceRuleController::class)->except(['show']);
    Route::get('payment/report',[ReportController::class, 'showPaymentForm'])->name('report.payment.index');
    Route::post('payment/report',[ReportController::class, 'paymentReport'])->name('report.payment');
});

Route::middleware(['auth', 'isAdminOrEmployee'])->group(function () {
    //insurance create process
    Route::get('/insurances', [InsuranceController::class, 'index'])->name('insurance.index');
    Route::get('/selectInsuranceType', [InsuranceController::class, 'selectInsuranceType'])->name('selectInsuranceType');
    Route::get('/checkInsuranceType', [InsuranceController::class, 'checkInsurance'])->name('checkInsuranceType');
    Route::post('/carInsuranceCreate', [InsuranceController::class, 'carInsuranceCreate'])->name('insuranceCreate.car');
    Route::post('/lifeInsuranceCreate', [InsuranceController::class, 'lifeInsuranceCreate'])->name('insuranceCreate.life');
    Route::post('/healthInsuranceCreate', [InsuranceController::class, 'healthInsuranceCreate'])->name('insuranceCreate.health');
    Route::get('/insurance-deed-print/{id}', [InsuranceController::class, 'insuranceDeedPrint'])->name('insurance.print');

    //withdraw
    Route::get('/insurance/withdraw', [InsuranceController::class, 'insuranceWithdraw'])->name('insurance.withdraw');
    Route::get('/withdraw/{id}', [InsuranceController::class, 'withdraw'])->name('withdraw');
    Route::put('/withdraw/update/{id}', [InsuranceController::class, 'withdrawUpdate'])->name('withdraw.update');
    Route::get('/insurance-withdraw-print/{id}', [InsuranceController::class, 'insuranceWithdrawPrint'])->name('insurance.withdraw.print');

    Route::get('/withdraw-selectInsurance', [InsuranceController::class, 'selectInsuranceWithdraw'])->name('withdraw.selectInsuranceType');
    Route::get('/withdraw-checkInsuranceType', [InsuranceController::class, 'checkInsuranceWithdraw'])->name('withdraw.checkInsuranceType');

    //payment
    Route::resource('/payment', PaymentController::class)->except(['show']);
});

Route::middleware(['auth', 'isCustomer'])->group(function () {
    Route::get('/customer/insurances', [CustomerController::class, 'insurance'])->name('customer.insurances');
    Route::get('/customer/payment-history', [CustomerController::class, 'payments'])->name('customer.payments');
});


