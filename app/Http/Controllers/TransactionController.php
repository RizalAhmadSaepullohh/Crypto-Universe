<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Cryptocurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TransactionController extends Controller
{
    public function index()
    {
        $wallet = Auth::user()->wallet;
        if ($wallet) {
            $transactions = $wallet->transactions()->with('cryptocurrency')->paginate(10);
        } else {
            $transactions = new LengthAwarePaginator(new Collection(), 0, 10);
        }
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        // Fetch all cryptocurrencies for the dropdown
        $cryptocurrencies = Cryptocurrency::all();
        return view('transactions.create', compact('cryptocurrencies'));
    }

    public function store(Request $request)
    {
        // Validate and store the transaction
        $request->validate([
            'cryptocurrency_id' => 'required|exists:cryptocurrencies,id',
            'transaction_date' => 'required|date',
            'type' => 'required|in:buy,sell',
            'amount' => 'required|numeric|min:0',
            'price_at_transaction' => 'required|numeric|min:0',
        ]);

        $wallet = Auth::user()->wallet;
        if (!$wallet) {
            return redirect()->route('transactions.index')->with('error', 'No wallet found. Please set up a wallet.');
        }

        Transaction::create([
            'wallet_id' => $wallet->id,
            'cryptocurrency_id' => $request->cryptocurrency_id,
            'transaction_date' => $request->transaction_date,
            'type' => $request->type,
            'amount' => $request->amount,
            'price_at_transaction' => $request->price_at_transaction,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully.');
    }

    public function edit(Transaction $transaction)
    {
        $cryptocurrencies = Cryptocurrency::all();
        return view('transactions.edit', compact('transaction', 'cryptocurrencies'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        // Add logic to validate and update a transaction
        $request->validate([
            'cryptocurrency_id' => 'required|exists:cryptocurrencies,id',
            'transaction_date' => 'required|date',
            'type' => 'required|in:buy,sell',
            'amount' => 'required|numeric|min:0',
            'price_at_transaction' => 'required|numeric|min:0',
        ]);

        $transaction->update($request->only([
            'cryptocurrency_id',
            'transaction_date',
            'type',
            'amount',
            'price_at_transaction',
        ]));

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}