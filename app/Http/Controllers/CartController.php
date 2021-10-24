<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        return view('carts.index', [
            'title' => 'Shopping Cart',
            'carts' => Cart::all()->where('user_id', auth()->user()->id)
        ]);
    }

    public function addItem($id)
    {
        $oldItem = Cart::where('game_id', $id)->where('user_id', auth()->user()->id)->first();
        if ($oldItem) {
            return back()->with('message', [
                'icon'  => 'error',
                'title' => 'Shopping Cart',
                'text'  => 'the game already in your shopping cart'
            ]);
        }
        Cart::create([
            'user_id' => auth()->user()->id,
            'game_id' => $id
        ]);
        return redirect('/')->with('message', [
            'icon'  => 'success',
            'title' => 'Shopping Cart',
            'text'  => 'the game was successfully added to cart'
        ]);
    }

    public function deleteItem($id)
    {
        Cart::destroy($id);
        return back()->with('message', [
            'icon'  => 'success',
            'title' => 'Shopping Cart',
            'text'  => 'item deleted successfully'
        ]);
    }
}
