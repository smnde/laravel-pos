<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Helper;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\OrderDetailService;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class OrdersController extends Controller
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
        return view('pages.orders.index', compact('products', 'items'));
    }

    public function addProduct($id)
    {
        $item = $this->product->getById($id);
        Cart::add($id, $item->name, 1, $item->purchase_price);
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
            $cart = Cart::content();
            $total = Cart::total();
            $items = $cart->map(function($item) {
                return [
                    'id' => $item->id,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'subtotal' => (int)$item->subtotal,
                ];
            });

            $order = Order::create([
                'invoice' => $request->invoice,
                'user_id' => Auth::id(),
                'total' => $total,
            ]);
            
            foreach ($items as $key => $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'subtotal' => $item['subtotal'],
                ]);    

                $product = $this->product->getById($item['id']);
                $product->update(['stock' => $product->stock + $item['qty']]);
            }

            DB::commit();
            Cart::destroy();
        });
        return redirect()->back();
    }
}
