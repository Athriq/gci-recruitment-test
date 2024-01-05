<div class="container bg-gray-50 shadow-md p-2 h-60 rounded-md">
    <div class="flex flex-col justify-between h-full">
        <div class="flex flex-col space-y-1">
            <img src="{{ $product->image_url }}" alt="product image">
            <p class="text-xs font-medium">{{ $product->name }}</p>
            <p class="text-sm font-bold text-blue-600">Rp<?php echo number_format($product->price, 0, '', '.'); ?></p>
        </div>
        <a class="bg-emerald-800 hover:bg-emerald-700 w-1/2 place-self-end rounded-md p-1 text-center text-gray-200" href="{{ route('products.checkout', ['product' => $product->id]) }}">Beli</a>
    </div>
</div>
