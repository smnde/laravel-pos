<?php

namespace App\Http\Controllers;

use App\Models\Helper;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Cart;
use Illuminate\Support\Facades\Date;

class OrdersController extends Controller
{
    protected $product;

    public function __construct(ProductRepository $productRepository)
    {
        $this->product = $productRepository;
    }

    // public function getAutoCode()
    // {
    //     $order = DB::table('orders')
    //                 ->where('invoice', 'like', 'INV%')
    //                 ->select('invoice')
    //                 ->orderBy('invoice', 'ASC')->first();

    //     if($order == null) {
    //         return 'INV0000001';
    //     } else {
    //         $invoice = str_replace('INV', '', $order->invoice);
    //         $invoice = (int) $invoice;
    //         $invoice = Helper::autocode(++$invoice, 7);

    //         return 'INV' . $invoice;
    //     }
    // }

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
            $total = (int) Cart::total();
            $cart = Cart::content();
            $items = $cart->map(function($item) {
                return [
                    'id' => $item->id,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'subtotal' => $item->subtotal,
                ];
            });

            $order = Order::create([
                'invoice' => $request->invoice,
                'user_id' => Auth::id(),
                'date' => Date::now(),
            ]);

            foreach ($items as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'total' => (int) $total,
                ]);

                $products = $this->product->getById($item['id']);
                $products->update(['stock' => $products->stock + $item['qty']]);
            }
            Cart::destroy();
            DB::commit();
        });
        return redirect()->back();
    }
}
