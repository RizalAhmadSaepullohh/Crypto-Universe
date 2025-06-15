<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class WalletController extends Controller
{
    /**
     * Menampilkan halaman untuk membuat atau mengedit wallet milik user.
     */
    public function show(Request $request)
    {
        // Ambil satu-satunya wallet milik user. Akan bernilai null jika belum ada.
        $wallet = $request->user()->wallet;

        return view('wallet.show', compact('wallet'));
    }

    /**
     * Membuat atau mengupdate wallet milik user.
     */
    public function storeOrUpdate(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'wallet_address' => [
                'required', 'string', 'min:20',
                // Rule unique ini memastikan alamat wallet tidak dipakai user lain
                Rule::unique('wallets')->ignore($request->user()->id, 'user_id')
            ],
            'balance' => 'required|numeric|min:0',
        ]);

        /**
         * Perintah ajaib dari Laravel: updateOrCreate
         * - Jika user sudah punya wallet, datanya akan di-update.
         * - Jika user belum punya wallet, wallet baru akan dibuat.
         */
        $request->user()->wallet()->updateOrCreate([], $validated);

        return redirect()->route('wallet.show')->with('success', 'Wallet saved successfully!');
    }
}