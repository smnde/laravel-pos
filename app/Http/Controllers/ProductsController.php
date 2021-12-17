<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\ProductService;

class ProductsController extends Controller
{
    private $product, $category;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->product = $productRepository;
        $this->category = $categoryRepository;
    }

    public function index()
    {
        $products = $this->product->getAll();
        $categories = $this->category->getAll();
        return view('pages.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = $this->category->getAll();
        return view('pages.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request, ProductService $service)
    {
        $service->create($request->all());
        return redirect()->route('products.index')->with('success', 'Barang berhasil ditambah');
    }

    public function edit($id)
    {
        $product = $this->product->getById($id);
        $categories = $this->category->getAll();
        return view('pages.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, ProductService $service, $id)
    {
        $service->update($request->all(), $id);
        return redirect()->route('products.index')->with('success', 'Barang berhasil diubah');
    }

    public function destroy(ProductService $service, $id)
    {
        $service->delete($id);
        return redirect()->back()->with('success', 'Barang berhasil dihapus');
    }
}
