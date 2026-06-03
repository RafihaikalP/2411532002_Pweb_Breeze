<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    {{-- ↓ TAMBAHKAN DI SINI ↓ --}}
                    <div class="mt-4 space-y-2">
                        <p>Nama&nbsp;&nbsp;: <strong>{{ Auth::user()->name }}</strong></p>
                        <p>Email&nbsp;&nbsp;: <strong>{{ Auth::user()->email }}</strong></p>
                        <p>No. HP : <strong>{{ Auth::user()->no_hp ?? '-' }}</strong></p>
                        <p>Role&nbsp;&nbsp;&nbsp;: <strong>{{ ucfirst(Auth::user()->role) }}</strong></p>
                    </div>
                    {{-- ↑ SAMPAI SINI ↑ --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>