<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Cart;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    protected $product;

    public function __construct(ProductRepository $productRepository)
    {
        $this->product = $productRepository;
    }

    public function index()
    {
        $products = $this->product->getAll();
        $items = Cart::content();
        return view('pages.sales.index', compact('products', 'items'));
    }

    public function addProduct($id)
    {
        $item = $this->product->getById($id);
        Cart::add($id, $item->name, 1, $item->sales_price);
        return redirect()->back();
    }

    public function removeProduct($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }

    public function clearCart()
    {
        Cart::destroy();
        return redirect()->back();
    }

    public function increase($rowId)
    {
        Cart::update($rowId, ['qty' => +1]);
        return redirect()->back();
    }

    public function decrease($rowId)
    {
        Cart::update($rowId, ['qty' => -1]);
        return redirect()->back();
    }

    public function save(Request $request)
    {
        DB::transaction(function() use($request) {
            $total = Cart::total();
            $cart = Cart::content();
            $items = $cart->map(function($item) {
                return [
                    'id' => $item->id,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'subtotal' => $item->subtotal,
                ];
            });

            Cart::destroy();
            DB::commit();
        });
    }
}
