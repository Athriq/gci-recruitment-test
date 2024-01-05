<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Voucher;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products', [
            'rows' => Product::all()
        ]);
    }

    public function checkout(Product $product)
    {
        return view('product-checkout', [
            'product' => $product,
            'voucherApplied' => null,
        ]);
    }

    public function applyVoucher(Product $product)
    {
        $voucher = Voucher::query()
            ->where('code', '=', request('voucher'))
            ->where('used', '=', 0)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($voucher) {
            // Not the best but works good enough
            request()->session()->put([
                'voucher.applied' => $voucher,
                'voucher.forProductId' => $product->id
            ]);
        }

        return redirect(route('products.checkout', [
            'product' => $product->id,
            'voucherInvalid' => $voucher == null,
        ]));
    }

    public function buy(Product $product)
    {
        $associatedVoucher = null;
        $appliedVoucher = null;

        if (request()->session()->has('voucher')) {
            /**
             * @var Voucher
             */
            $appliedVoucher = request()->session()->pull('voucher')['applied'];
        }

        if ($product->price >= 2000000) {
            $associatedVoucher = Voucher::factory()->create();
        }

        Transaction::factory()->create([
            'product_id' => $product->id,
            'associated_voucher_id' => $associatedVoucher->id ?? null,
            'applied_voucher_id' => $appliedVoucher->id ?? null
        ]);

        if ($appliedVoucher) {
            $appliedVoucher->used = true;
            $appliedVoucher->save();
        }

        return redirect(route('products.checkout', [
            'product' => $product->id,
            'bought' => true
        ]));
    }
}
