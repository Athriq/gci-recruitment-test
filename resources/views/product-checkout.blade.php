@section('title', 'Checkout')

@props(['product'])

<x-app-layout>
    <div class="container self-center bg-gray-50 rounded-md shadow-md p-4 w-2/3 space-y-2">
        <div class="flex flex-col space-y-4">
            @if (request()->get('bought'))
                <div class="flex flex-row items-center self-center py-4">
                    <p class="text-xl font-bold">Transaksi Berhasil!</p>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="50px" height="50px">
                        <linearGradient id="IMoH7gpu5un5Dx2vID39Ra" x1="9.858" x2="38.142" y1="9.858"
                            y2="38.142" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="#9dffce" />
                            <stop offset="1" stop-color="#50d18d" />
                        </linearGradient>
                        <path fill="url(#IMoH7gpu5un5Dx2vID39Ra)"
                            d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z" />
                        <linearGradient id="IMoH7gpu5un5Dx2vID39Rb" x1="13" x2="36" y1="24.793"
                            y2="24.793" gradientUnits="userSpaceOnUse">
                            <stop offset=".824" stop-color="#135d36" />
                            <stop offset=".931" stop-color="#125933" />
                            <stop offset="1" stop-color="#11522f" />
                        </linearGradient>
                        <path fill="url(#IMoH7gpu5un5Dx2vID39Rb)"
                            d="M21.293,32.707l-8-8c-0.391-0.391-0.391-1.024,0-1.414l1.414-1.414	c0.391-0.391,1.024-0.391,1.414,0L22,27.758l10.879-10.879c0.391-0.391,1.024-0.391,1.414,0l1.414,1.414	c0.391,0.391,0.391,1.024,0,1.414l-13,13C22.317,33.098,21.683,33.098,21.293,32.707z" />
                    </svg>
                </div>
                <p class="text-center">Mengalihkan laman...</p>
                <script>
                    setTimeout(function() {
                        window.location.href = "/"
                    }, 3000);
                </script>
            @else
                <h1 class="font-bold text-xl">Checkout</h1>
                <div class="flex flex-row space-x-2">
                    <img src="{{ $product->image_url }}" width="100" alt="product image">
                    <div class="flex flex-col justify-center">
                        <p class="text-lg">{{ $product->name }}</p>
                        <p class="text-lg font-bold text-blue-600">Rp<?php echo number_format($product->price, 0, '', '.'); ?></p>
                    </div>
                </div>
                <div class="flex flex-col space-y-2">
                    @if (session('voucher.forProductId') == $product->id)
                        <?php $voucher = session('voucher.applied') ?>
                        <label for="voucher">Kode Voucher</label>
                        <div class="flex flex-row justify-between bg-gray-100 p-2">
                            <p>{{ $voucher->code }}</p>
                            <p>-Rp{{ number_format($voucher->nominal, 0, '', '.') }}</p>
                        </div>
                    @else
                        <form method="POST" action="{{ route('products.apply-voucher', ['product' => $product->id]) }}"
                            class="space-y-2">
                            @csrf
                            <label for="voucher">Kode Voucher</label>
                            <div class="flex flex-row space-x-2">
                                <input type="text" name="voucher" id="voucher"
                                    class="rounded-md outline outline-1 outline-cyan-700 p-2 w-full">
                                <input type="submit" value="Terapkan"
                                    class="bg-orange-500 hover:bg-orange-400 rounded-md text-white text-center p-2 cursor-pointer">
                            </div>
                            @if (request()->input('voucherInvalid'))
                                <p class="text-red-500">Kode voucher tidak valid atau sudah kadaluarsa.</p>
                            @endif
                        </form>
                    @endif
                </div>
                <div class="flex flex-row space-x-4 justify-between">
                    <p class="font-bold text-lg">Total</p>
                    <p class="font-bold text-lg text-blue-600">
                        Rp{{ number_format($product->price - ($voucher->nominal ?? 0), 0, '', '.') }}</p>
                </div>
                <a class="bg-cyan-700 hover:bg-cyan-600 p-2 text-white text-center rounded-md"
                    href="{{ route('products.buy', ['product' => $product->id]) }}">Bayar</a>
            @endif
        </div>
    </div>
</x-app-layout>
