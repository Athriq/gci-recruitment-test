@section('title', 'Riwayat Transaksi')

@props(['rows'])

<x-app-layout>
    <div class="flex flex-col space-y-4">
        @foreach ($rows as $row)
            <x-transaction-card :transaction="$row"/>
        @endforeach
    </div>
</x-app-layout>
