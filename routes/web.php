<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Invitation Views (Must be reachable by guests)
Route::get('/v/{invitation:slug}', [InvitationController::class, 'show'])->name('invitations.show');
Route::post('/v/{invitation:slug}/message', [InvitationController::class, 'storeMessage'])->name('invitations.message');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard (User)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Invitations Management
    Route::resource('invitations', InvitationController::class);
    Route::get('/invitations/{invitation}/preview', [InvitationController::class, 'preview'])->name('invitations.preview');
    Route::get('/invitations/{invitation}/edit/content', [InvitationController::class, 'editContent'])->name('invitations.edit-content');
    Route::delete('/messages/{message}', [InvitationController::class, 'destroyMessage'])->name('messages.destroy');
    Route::post('/invitations/{invitation}/upload', [InvitationController::class, 'upload'])->name('invitations.upload');
    Route::match(['post', 'patch'], '/invitations/{invitation}/save', [InvitationController::class, 'save'])->name('invitations.save');
    Route::get('/invitations/{invitation}/guests', [InvitationController::class, 'guests'])->name('invitations.guests');
    Route::post('/invitations/{invitation}/guests', [GuestController::class, 'store'])->name('guests.store');
    Route::post('/invitations/{invitation}/guests/import', [GuestController::class, 'import'])->name('guests.import');
    Route::get('/guests/template', [GuestController::class, 'downloadTemplate'])->name('guests.template');
    Route::patch('/guests/{guest}', [GuestController::class, 'update'])->name('guests.update');
    Route::delete('/guests/{guest}', [GuestController::class, 'destroy'])->name('guests.destroy');

    // Themes & Packages
    Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
    Route::get('/themes/{id}/preview', [ThemeController::class, 'show'])->name('themes.preview'); // Aligned with view naming
    
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');

    // Transactions / Checkout Flow (Universal Mapping)
    Route::get('/checkout/{package:id}/{invitation:id}', [TransactionController::class, 'preCheckout'])->name('packages.checkout');
    Route::get('/checkout-intent/{package:id}/{invitation:id}', [TransactionController::class, 'preCheckout'])->name('transactions.checkout'); // Alias to prevent errors
    
    Route::post('/checkout/{package:id}/{invitation:id}', [TransactionController::class, 'store'])->name('transactions.store');
    
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.history');
    Route::get('/transactions/{transaction:id}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::post('/transactions/{transaction:id}/upload', [TransactionController::class, 'uploadProof'])->name('transactions.upload');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Control Hub
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('invitations', \App\Http\Controllers\Admin\InvitationController::class);
    Route::resource('themes', \App\Http\Controllers\Admin\ThemeController::class);
    Route::resource('packages', \App\Http\Controllers\Admin\PackageController::class);
    
    // Transactions Management
    Route::resource('transactions', \App\Http\Controllers\Admin\TransactionController::class);
    Route::post('/transactions/{transaction}/confirm', [\App\Http\Controllers\Admin\TransactionController::class, 'confirm'])->name('transactions.confirm');
    Route::post('/transactions/{transaction}/cancel', [\App\Http\Controllers\Admin\TransactionController::class, 'cancel'])->name('transactions.cancel');
    
    // Payment Methods Management
    Route::resource('payment-methods', \App\Http\Controllers\Admin\PaymentMethodController::class);
    Route::post('/payment-methods/{payment_method}/toggle', [\App\Http\Controllers\Admin\PaymentMethodController::class, 'toggle'])->name('payment-methods.toggle');

    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

require __DIR__ . '/auth.php';
