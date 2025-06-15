<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- Sesuaikan judul untuk halaman edit --}}
            {{ isset($transaction) ? 'Edit Transaction' : 'Add New Transaction' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">There were some problems with your input.</span>
                            <ul class="mt-3 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ isset($transaction) ? route('transactions.update', $transaction) : route('transactions.store') }}" method="POST" class="space-y-6">
                        @csrf
                        @if(isset($transaction))
                            @method('PUT')
                        @endif

                        <div>
                            <x-input-label for="cryptocurrency_id" :value="__('Cryptocurrency')" />
                            <x-select-input id="cryptocurrency_id" name="cryptocurrency_id" class="mt-1 block w-full" required>
                                @foreach($cryptocurrencies as $crypto)
                                    <option value="{{ $crypto->id }}" {{ (isset($transaction) && $transaction->cryptocurrency_id == $crypto->id) || old('cryptocurrency_id') == $crypto->id ? 'selected' : '' }}>
                                        {{ $crypto->name }} ({{ $crypto->symbol }})
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('cryptocurrency_id')" />
                        </div>
                        
                        <div>
                            <x-input-label for="type" :value="__('Transaction Type')" />
                            <x-select-input id="type" name="type" class="mt-1 block w-full" required>
                                <option value="buy" {{ (isset($transaction) && $transaction->type == 'buy') || old('type') == 'buy' ? 'selected' : '' }}>Buy</option>
                                <option value="sell" {{ (isset($transaction) && $transaction->type == 'sell') || old('type') == 'sell' ? 'selected' : '' }}>Sell</option>
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('type')" />
                        </div>

                        <div>
                            <x-input-label for="amount" :value="__('Amount')" />
                            <x-text-input id="amount" name="amount" type="number" step="any" class="mt-1 block w-full" :value="old('amount', $transaction->amount ?? '')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                        </div>
                        
                        <div>
                            <x-input-label for="price_at_transaction" :value="__('Price per Coin (USD)')" />
                            <x-text-input id="price_at_transaction" name="price_at_transaction" type="number" step="any" class="mt-1 block w-full" :value="old('price_at_transaction', $transaction->price_at_transaction ?? '')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price_at_transaction')" />
                        </div>

                        <div>
                            <x-input-label for="transaction_date" :value="__('Transaction Date')" />
                            <x-text-input id="transaction_date" name="transaction_date" type="datetime-local" class="mt-1 block w-full" :value="old('transaction_date', isset($transaction) ? \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d\TH:i') : '')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('transaction_date')" />
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Transaction') }}</x-primary-button>
                            <a href="{{ route('transactions.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>