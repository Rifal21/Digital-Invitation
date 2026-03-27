<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ThemeController as AdminTheme;
use App\Http\Controllers\Admin\PackageController as AdminPackage;
use App\Http\Controllers\Admin\InvitationController as AdminInvitation;
use App\Http\Controllers\Admin\TransactionController as AdminTransaction;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'profile.complete'])->name('dashboard');

// Theme Browsing (Public)
Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
Route::get('/themes/{slug}', [ThemeController::class, 'show'])->name('themes.preview');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Pricing
    Route::get('/pricing', [PackageController::class, 'index'])->name('packages.index');
    
    // Purchase process
    Route::post('/buy/{package}', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/checkout/{transaction}', [TransactionController::class, 'checkout'])->name('transactions.checkout');
    Route::post('/checkout/{transaction}', [TransactionController::class, 'uploadProof'])->name('transactions.upload');
    Route::get('/checkout/{transaction}/doku', [TransactionController::class, 'payWithDoku'])->name('transactions.doku.pay');
    Route::get('/my-orders', [TransactionController::class, 'index'])->name('transactions.history');

    // Invitations (Protected by profile completion and package purchase)
    Route::get('invitations/{invitation}/edit', [InvitationController::class, 'editor'])->name('invitations.edit')->middleware(['profile.complete', 'package.purchased']);
    Route::patch('invitations/{invitation}/save', [InvitationController::class, 'save'])->name('invitations.save')->middleware(['profile.complete', 'package.purchased']);
    Route::post('invitations/{invitation}/upload', [InvitationController::class, 'upload'])->name('invitations.upload')->middleware(['profile.complete', 'package.purchased']);
    Route::delete('messages/{message}', [InvitationController::class, 'destroyMessage'])->name('messages.destroy')->middleware(['profile.complete', 'package.purchased']);
    Route::resource('invitations', InvitationController::class)->except(['edit', 'update', 'show'])->middleware(['profile.complete', 'package.purchased']);
});

// Public Invitation Views & Messaging
Route::get('undangan/{invitation:slug}', [InvitationController::class, 'show'])->name('invitations.show');
Route::post('undangan/{invitation:slug}/message', [InvitationController::class, 'storeMessage'])->name('invitations.message');

    // Admin Routes (Protected by auth and admin role)
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::resource('themes', AdminTheme::class);
        Route::resource('packages', AdminPackage::class);
        Route::resource('invitations', AdminInvitation::class);
        
        // Transaction Management
        Route::get('transactions', [AdminTransaction::class, 'index'])->name('transactions.index');
        Route::post('transactions/{transaction}/confirm', [AdminTransaction::class, 'confirm'])->name('transactions.confirm');
        Route::post('transactions/{transaction}/cancel', [AdminTransaction::class, 'cancel'])->name('transactions.cancel');

        // Payment Methods Management
        Route::resource('payment-methods', \App\Http\Controllers\Admin\PaymentMethodController::class);
        Route::patch('payment-methods/{payment_method}/toggle', [\App\Http\Controllers\Admin\PaymentMethodController::class, 'toggle'])->name('payment-methods.toggle');

        // Global Settings
        Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::patch('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });

require __DIR__.'/auth.php';
