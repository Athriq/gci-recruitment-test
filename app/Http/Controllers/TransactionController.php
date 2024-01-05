<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transactions', [
            'rows' => Transaction::all()
        ]);
    }

    public function show(Transaction $transaction)
    {
        return view('invoice', [
            'transaction' => $transaction
        ]);
    }
}
