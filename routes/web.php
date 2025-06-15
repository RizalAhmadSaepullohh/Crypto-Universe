<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LogViewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Http\Controllers\WalletController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        // Ambil wallet milik user yang sedang login
        $wallet = Auth::user()->wallet;

        // Siapkan variabel default
        $recentTransactions = collect(); // koleksi kosong
        $transactionCount = 0;

        // Hanya jika user punya wallet, kita ambil datanya
        if ($wallet) {
            $transactionCount = $wallet->transactions()->count();
            $recentTransactions = $wallet->transactions()
                ->with('cryptocurrency') // Ambil juga data crypto-nya
                ->latest() // Urutkan dari yang terbaru
                ->take(5) // Ambil 5 saja
                ->get();
        }

        // Kirim data ke view
        return view('dashboard', [
            'transactionCount' => $transactionCount,
            'recentTransactions' => $recentTransactions
        ]);
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Profile Routes from Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Transaction CRUD Routes
    Route::resource('transactions', TransactionController::class);

    // Log Viewer Route
    Route::get('/logs', [LogViewController::class, 'index'])->name('logs.index');



    Route::get('wallet', [WalletController::class, 'show'])->name('wallet.show');
    Route::post('wallet', [WalletController::class, 'storeOrUpdate'])->name('wallet.save');
    
    // Route transactions tetap sama
    Route::resource('transactions', TransactionController::class);
});

require __DIR__ . '/auth.php';
