<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 overflow-hidden overflow-x-auto bg-white border-b border-gray-200">
                    <div class="container">
                        @if ($errors->any())
                            <div class="pt-3">
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                    role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if (session()->has('message'))
                            <div class="pt-3">
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                                    role="alert">
                                    {{ session('message') }}
                                </div>
                            </div>
                        @endif

                    </div>

                    <div>
                        <x-label for="Aduan" value="{{ __('Aduan') }}" />
                        <textarea id="Aduan" class="block mt-1 w-full" wire:model="aduan" required autofocus autocomplete="Aduan"
                            rows="4"></textarea>
                    </div>

                    <div class="col-span-12">
                        <div class="mt-4">
                            <x-label for="bukti" value="{{ __('Bukti') }}" />
                            <x-input wire:model="bukti" id="bukti" class="block mt-1 w-full" type="file"
                                autocomplete="bukti" />
                        </div>
                    </div>

                    <div>
                        <x-label for="tanggal" value="{{ __('tanggal') }}" />
                        <x-input wire:model="tanggal" id="tanggal" class="block mt-1 w-full" type="date"
                            autocomplete="image" />
                    </div>

                    <x-button wire:click="store" class="mt-4">
                        {{ __('Kirim') }}
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</div>
