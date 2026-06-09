<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AdminSubscriptionReportController;
use App\Http\Controllers\ProfileController;
Route::get('/', function () {
    return view('welcome');
});

    Route::get('/dashboard', [AdminSubscriptionReportController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');
        
    Route::get('/plans', [SubscriptionController::class, 'plans'])
        ->middleware(['auth', 'verified'])
        ->name('plans');

Route::middleware(['auth'])->group(function () {
    Route::get('/plans', [SubscriptionController::class, 'plans'])
        ->name('plans');
    Route::post('/plans/{plan}/checkout', [SubscriptionController::class, 'checkout'])
        ->name('subscriptions.checkout');
    Route::get('/subscriptions/{subscription}/payment', [SubscriptionController::class, 'payment'])
        ->name('subscriptions.payment');
    Route::post('/subscriptions/{subscription}/pay', [SubscriptionController::class, 'pay'])
        ->name('subscriptions.pay');
    Route::get('/my-subscriptions', [SubscriptionController::class, 'my'])
        ->name('subscriptions.my');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


    Route::middleware(['auth', 'admin'])->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
      
        Route::get('/admin/subscription-report', [AdminSubscriptionReportController::class, 'index'])
        ->name('admin.subscription-report');

});

    Route::get('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
})->middleware('auth')->name('logout');

require __DIR__.'/auth.php';
