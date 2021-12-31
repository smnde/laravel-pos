<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Helper;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Cart;
use Illuminate\Http\Request;
use Exception;

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
        $total = Cart::total();

        DB::beginTransaction();
        try {
            $cart = Cart::content();
            $items = $cart->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'subtotal' => $item->subtotal,
                ];
            });

            $order = Order::create([
                'invoice' => $request->invoice,
                'user_id' => Auth::id(),
                'total' => $total,
            ]);

            foreach ($items as $key => $item) {
                $orderDetails[$key] = [
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ];
                $product = $this->product->getById($item['id'])->increment('stock', $item['qty']);
            }
            OrderDetail::insert($orderDetails);

            DB::commit();
            Cart::destroy();
            return redirect()->back()->with('success', 'Transaksi berhasil');
        } catch (\Exception $err) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Transaksi gagal');
        }
    }
}