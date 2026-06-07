<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AdminSubscriptionReportController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [SubscriptionController::class, 'plans'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
 Route::get('/plans', [SubscriptionController::class, 'plans'])
 ->name('subscriptions.plans');
 Route::post('/plans/{plan}/checkout', [SubscriptionController::class, 'checkout'])
 ->name('subscriptions.checkout');
 Route::get('/subscriptions/{subscription}/payment', [SubscriptionController::class, 'payment'])
 ->name('subscriptions.payment');
 Route::post('/subscriptions/{subscription}/pay', [SubscriptionController::class, 'pay'])
 ->name('subscriptions.pay');
 Route::get('/my-subscriptions', [SubscriptionController::class, 'my'])
 ->name('subscriptions.my');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('expenses', App\Http\Controllers\ExpenseController::class)->except(['show']);
    Route::resource('income', App\Http\Controllers\IncomeController::class)->except(['show']);
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
