<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SalesDetail;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Exception;
use Cart;
use Auth;
use DB;

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
        $receipt = IdGenerator::generate([
            'table' => 'sales',
            'length' => 9,
            'prefix' => 'SL-',
            'field' => 'receipt',
        ]);
        return view('pages.sales.index', compact('products', 'items', 'receipt'));
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

            $sale = Sale::create([
                'receipt' => $request->receipt,
                'user_id' => Auth::id(),
                'total' => Cart::total(),
            ]);

            foreach ($items as $key => $item) {
                $details[$key] = [
                    'sales_id' => $sale->id,
                    'product_id' => $item['id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ];

                $product = $this->product->getById($item['id'])->decrement('stock', $item['qty']);
            }
            SalesDetail::insert($details);

            DB::commit();
            Cart::destroy();
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
