<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        if (Cart::containDeletedAdmin()) {
            return back()->with('message', [
                'icon'  => 'error',
                'title' => 'Shopping Cart',
                'text'  => 'there is a game that has been deleted by admin, please delete first'
            ]);
        }

        return view('transaction.index', [
            'title'     => 'Transaction Information',
            'countries' => Transaction::countries(),
            'total'     => Transaction::getTotalPrice()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'card_name'     => 'required|min:6',
                'card_number'   => 'required|regex:/([0-9]{4})\s([0-9]{4})\s([0-9]{4})\s([0-9]{4})/',
                'expired_month' => 'required|numeric|between:1,12',
                'expired_year'  => 'required|numeric|between:' . date('Y') . ',2050',
                'cvc'           => 'required|numeric|between:100,9999',
                'country'       => 'required',
                'zip'           => 'required|numeric',
                'total'         => 'required'
            ],
            [
                'card_number.regex' => "card number must be in '0000 0000 0000 0000' format."
            ]
        );
        dd();
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['receipt_id'] = Str::random(50);


        $lastID = Transaction::create($validatedData)->id;
        $carts = Cart::all()->where('user_id', auth()->user()->id);
        $user = User::find(auth()->user()->id);
        $user->update([
            'level' => $user->level + count($carts)
        ]);

        foreach ($carts as $cart) {
            DetailTransaction::create([
                'transaction_id' => $lastID,
                'game_id'        => $cart->game->id
            ]);

            Cart::destroy($cart->id);
        }

        return redirect('/')->with('message', [
            'icon'  => 'success',
            'title' => 'Transaction',
            'text'  => 'successfully made'
        ]);
    }

    public function receipt()
    {
        $transaction = Transaction::latest()->where('user_id', auth()->user()->id)->first();
        $detailTransaction = $transaction->detailTransaction;
        return view('transaction.receipt', [
            'title'             => 'Transaction Receipt',
            'transaction'       => $transaction,
            'detailTransaction' => $detailTransaction
        ]);
    }

    public function history()
    {
        return view('transaction.history', [
            'title'        => 'Transaction History',
            'transactions' => Transaction::latest()->where('user_id', auth()->user()->id)->get()
        ]);
    }
}
