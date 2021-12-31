<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    protected $product;

    public function __construct(ProductRepository $productRepository)
    {
        $this->product = $productRepository;
    }

    public function create($data)
    {
        $product = Product::create([
            'code' => $data['code'],
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'stock' => 0,
            'purchase_price' => $data['purchase_price'],
            'sales_price' => $data['sales_price'],
        ]);
        return $product;
    }

    public function update($data, $id)
    {
        $product = $this->product->getById($id);
        $product->update([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'purchase_price' => $data['purchase_price'],
            'sales_price' => $data['sales_price'],
        ]);
        return $product;
    }

    // public function save(Request $request)
    // {
    //     // DB::transaction(function() use($request) {
    
    //         $total = (int) Cart::total();
    //         $cart = Cart::content();
    //         $items = $cart->map(function($item) {
    //             return [
    //                 'id' => (int)$item->id,
    //                 'qty' => $item->qty,
    //                 'price' => $item->price,
    //                 'subtotal' => (int)$item->subtotal,
    //             ];
    //         });

    //         $order = Order::create([
    //             'invoice' => $request->invoice,
    //             'user_id' => Auth::id(),
    //             'total' => $total,
    //         ]);

    //         $orderDetails = [];

    //         foreach ($items as $key => $item) {
    //             $orderDetails[] = [
    //                 'order_id' => $order->id,
    //                 'product_id' => $item['id'],
    //                 'price' => $item['price'],
    //                 'qty' => $item['qty'],
    //                 'subtotal' => $item['subtotal'],
    //             ];

    //             $products[] = Product::findOrFail($item['id']);
    //         };

            

            // $products[] = Product::findOrFail($orderDetails['product_id']);
            // return $products;

            // foreach ($orderDetails as $key =>$detail) {
            //     $products[] = [
            //         'id' => $detail['product_id'],
            //         'qty' => + $detail['qty'],
            //     ];
            // }

            // OrderDetail::insert($orderDetails);

            // Cart::destroy(); // ini hapusnya

            // harus di loop, product cart nya bsa lebih dr 1
            // kalo pake kodingan awal ini jalan sebenernya
            // iya jalan, tapi yg ke update cmn 1 product. klo cart nya ada 3 gmn, masa find by id nya cmn 1
            // ohiya ya.
            // kocak lu.
            // yamaap wkwwk
            // mamam tuh backend hahaha .
            // ini juga grgr clean code dan segala tetek bengeknya kalo simple aja yg penting jalan mah udah beres wkwkw

            // bikin service product. bikin method updateProductsStock([
            //     'product_id' => $orderDetail['product_id'],
            //     'qty' => $orderDetail['qty']
            // ])
            // oke, dapat dipahami.

            // loop nya di service aja, disini cmn kirim array, product id sm qty,
            // $param = [
            //     ['pdct_id' => 1, 'qty' => 2],
            //     ['pdct_id' => 2, 'qty' => 2],
            //     ['pdct_id' => 3, 'qty' => 2],
            // ];

            // $this->service_product->updateProductStocks($param);

            // dah gt aja mau tidur gw... okeee.. tengkyuu...ok
        //     DB::commit();
        // });
        // return redirect()->back();
    // }

    public function delete($id)
    {
        $this->product->getById($id)->delete();
    }
}