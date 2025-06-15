<?php

namespace App\Http\Controllers;

use App\Models\Cryptocurrency; // Jangan lupa import model
use Illuminate\Http\Request;

class CryptocurrencyController extends Controller
{
    /**
     * Menampilkan daftar semua cryptocurrency.
     * GET /cryptocurrencies
     */
    public function index()
    {
        // Mengambil semua data cryptocurrency dari database, dengan pagination 10 item per halaman
        $cryptocurrencies = Cryptocurrency::paginate(10);
        
        // Mengembalikan view 'cryptocurrencies.index' dan mengirimkan data cryptocurrencies
        return view('cryptocurrencies.index', compact('cryptocurrencies'));
    }

    /**
     * Menampilkan form untuk membuat cryptocurrency baru.
     * GET /cryptocurrencies/create
     */
    public function create()
    {
        // Hanya mengembalikan view dengan form
        return view('cryptocurrencies.create');
    }

    /**
     * Menyimpan cryptocurrency yang baru dibuat ke dalam database.
     * POST /cryptocurrencies
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255|unique:cryptocurrencies',
            'symbol' => 'required|string|max:10|unique:cryptocurrencies',
        ]);

        // 2. Jika validasi berhasil, buat data baru
        Cryptocurrency::create($request->all());

        // 3. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('cryptocurrencies.index')
                         ->with('success', 'Cryptocurrency created successfully.');
    }

    /**
     * Menampilkan detail satu cryptocurrency spesifik.
     * GET /cryptocurrencies/{id}
     */
    public function show(Cryptocurrency $cryptocurrency)
    {
        // Menggunakan Route Model Binding untuk otomatis menemukan data berdasarkan ID
        // Mengembalikan view 'cryptocurrencies.show' dan mengirimkan data cryptocurrency yang ditemukan
        return view('cryptocurrencies.show', compact('cryptocurrency'));
    }

    /**
     * Menampilkan form untuk mengedit data cryptocurrency.
     * GET /cryptocurrencies/{id}/edit
     */
    public function edit(Cryptocurrency $cryptocurrency)
    {
        // Menggunakan Route Model Binding
        // Mengembalikan view 'cryptocurrencies.edit' dan mengirimkan data yang akan di-edit
        return view('cryptocurrencies.edit', compact('cryptocurrency'));
    }

    /**
     * Memperbarui data cryptocurrency di database.
     * PUT/PATCH /cryptocurrencies/{id}
     */
    public function update(Request $request, Cryptocurrency $cryptocurrency)
    {
        // 1. Validasi input, pastikan 'unique' mengabaikan data saat ini
        $request->validate([
            'name' => 'required|string|max:255|unique:cryptocurrencies,name,' . $cryptocurrency->id,
            'symbol' => 'required|string|max:10|unique:cryptocurrencies,symbol,' . $cryptocurrency->id,
        ]);

        // 2. Jika validasi berhasil, update data
        $cryptocurrency->update($request->all());

        // 3. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('cryptocurrencies.index')
                         ->with('success', 'Cryptocurrency updated successfully.');
    }

    /**
     * Menghapus data cryptocurrency dari database.
     * DELETE /cryptocurrencies/{id}
     */
    public function destroy(Cryptocurrency $cryptocurrency)
    {
        // Menggunakan Route Model Binding untuk menemukan data, lalu hapus
        $cryptocurrency->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('cryptocurrencies.index')
                         ->with('success', 'Cryptocurrency deleted successfully.');
    }
}