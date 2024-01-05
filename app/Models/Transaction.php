<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::created(function (Transaction $transaction) {
            // Cuma dekorasi, hapus file session untuk reset
            $balance = session('balance', 15000000);
            $finalBalance = $balance - (
                $transaction->product()->get()->first()->price -
                ($transaction->appliedVoucher()->get()->first()->nominal ?? 0));
            session(['balance' => $finalBalance]);
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function appliedVoucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'applied_voucher_id');
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'associated_voucher_id');
    }
}
