<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Cart;
use Exception;

class PurchasesController extends Controller
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
        return view('pages.purchases.index', compact('products', 'items'));
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
        $item = Cart::get($rowId);
        Cart::update($rowId, ['qty' => $item->qty + 1]);
        return redirect()->back();
    }

    public function decrease($rowId)
    {
        $item = Cart::get($rowId);
        Cart::update($rowId, ['qty' => $item->qty - 1]);
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

            $purchase = Purchase::create([
                'invoice' => $request->invoice,
                'user_id' => Auth::id(),
                'total' => $total,
            ]);

            foreach ($items as $key => $item) {
                $details[$key] = [
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ];
                $product = $this->product->getById($item['id'])->increment('stock', $item['qty']);
            }

            PurchaseDetail::insert($details);

            DB::commit();
            Cart::destroy();
            return redirect()->back()->with('success', 'Transaksi berhasil');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Transaksi gagal');
        }
    }
}