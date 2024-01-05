@section('title', 'Faktur Penjualan')

@props(['transaction'])

<x-app-layout>
    <?php
    $product = $transaction->product()->get()->first();
    $voucher = $transaction->voucher()->get()->first();
    $appliedVoucher = $transaction->appliedVoucher()->get()->first();
    $formattedCost = number_format($product->price, 0, '', '.');
    $finalFormattedCost = number_format($product->price - ($appliedVoucher->nominal ?? 0), 0, '', '.');
    ?>
    <!-- TODO: Terlalu hardcoded tapi gak ada waktu :\ -->
    <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
            <p class="font-bold text-3xl">Invoice</p>
            <div class="flex flex-row">
                <p class="w-full">ID Faktur:</p>
                <p class="w-full">{{ $transaction->id }}</p>
            </div>
            <hr>
            <div class="flex flex-row">
                <p class="w-full">Penjual:</p>
                <p class="w-full">{{ $product->vendor }}</p>
            </div>
            <hr>
            <div class="flex flex-row">
                <p class="w-full">Tanggal:</p>
                <p class="w-full">{{ $product->created_at }}</p>
            </div>
        </div>
        <div class="flex flex-col space-y-2 px-2">
            <div class="grid grid-cols-4 gap-4 font-bold">
                <p>Nama Produk</p>
                <p class="text-center">Jumlah Barang</p>
                <p class="text-center">Harga Barang</p>
                <p class="text-end">Subtotal</p>
            </div>
            <div class="grid grid-cols-4 gap-4 text-sm">
                <p>{{ $product->name }}</p>
                <p class="text-center">1</p>
                <p class="text-center">Rp {{ $formattedCost }}</p>
                <p class="text-end">Rp {{ $formattedCost }}</p>
            </div>
        </div>
        <div class="flex flex-row justify-between bg-gray-300 font-bold p-2">
            <p>Subtotal</p>
            <p>Rp {{ $formattedCost }}</p>
        </div>

        @if ($appliedVoucher != null)
        <div class="flex flex-col space-y-2 px-2">
            <div class="grid grid-cols-2 gap-4 font-bold">
                <p>Voucher</p>
                <p class="text-end">Subtotal</p>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <p>{{ $appliedVoucher->code }}</p>
                <p class="text-end">- Rp {{ number_format($appliedVoucher->nominal, 0, '', '.'); }}</p>
            </div>
        </div>
        <div class="flex flex-row justify-between bg-gray-300 font-bold p-2">
            <p>Subtotal</p>
            <p>- Rp {{ number_format($appliedVoucher->nominal, 0, '', '.'); }}</p>
        </div>
        @endif

        <div class="grid grid-cols-2 gap-4 font-bold self-end w-1/2 text-emerald-500 text-lg">
            <p>Total</p>
            <p class="text-end">Rp {{ $finalFormattedCost }}</p>
        </div>

        @if ($voucher != null)
        <div class="flex flex-col space-y-1">
            <div class="grid grid-cols-2 gap-4 font-bold self-end w-1/2 text-lg px-4">
                <p>Voucher</p>
            </div>
            <div class="grid grid-cols-2 gap-4 self-end w-1/2 px-4">
                <p>{{ $voucher->code }}</p>
                <p class="text-end">Rp {{ number_format($voucher->nominal, 0, '', '.') }}</p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 self-end w-1/2 bg-gray-300 font-bold px-4 py-2">
            <p>Subtotal</p>
            <p class="text-end">Rp {{ number_format($voucher->nominal, 0, '', '.') }}</p>
        </div>
        @endif

    </div>
</x-app-layout>
