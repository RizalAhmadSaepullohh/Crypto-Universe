<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Wallet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        {{-- Judul akan berubah tergantung kondisi --}}
                        {{ $wallet ? 'Update Your Wallet Information' : 'Create Your Wallet' }}
                    </h3>

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md" role="alert">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('wallet.save') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <x-input-label for="wallet_address" :value="__('Wallet Address')" />
                            <x-text-input id="wallet_address" name="wallet_address" type="text" class="mt-1 block w-full" :value="old('wallet_address', $wallet->wallet_address ?? '')" required autofocus />
                        </div>
                        
                        <div>
                            <x-input-label for="balance" :value="__('Current Balance (USD)')" />
                            <x-text-input id="balance" name="balance" type="number" step="0.01" class="mt-1 block w-full" :value="old('balance', $wallet->balance ?? '0.00')" required />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Wallet') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>