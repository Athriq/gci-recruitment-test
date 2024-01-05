<div class="container shadow-md rounded-md flex flex-col p-4">
    <div class="flex flex-row justify-between">
        <div class="flex flex-row space-x-2">
            <img src="{{ $transaction->product()->get()->first()->image_url }}" width="100" alt="product image">
            <div class="flex flex-col justify-center">
                <p class="text-lg">{{ $transaction->product()->get()->first()->name }}</p>
                <p class="text-lg font-bold text-blue-600">Rp<?php echo number_format(
                    $transaction
                        ->product()
                        ->get()
                        ->first()->price,
                    0,
                    '',
                    '.',
                ); ?></p>
            </div>
        </div>
        <a class=" text-blue-600 hover:text-blue-800 self-end"
            href="{{ route('transactions.show', ['transaction' => $transaction->id]) }}">Lihat Faktur Penjualan</a>
    </div>
</div>
