<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;

class CategoriesController extends Controller
{
    private $category;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->category = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->category->getAll();
        return view('pages.products.categories', compact('categories'));
    }

    public function store(StoreCategoryRequest $request, CategoryService $service)
    {
        $service->create($request->all());
        return redirect()->back()->with('success', 'Kategori baru berhasil ditambahkan');
    }

    public function update(StoreCategoryRequest $request, CategoryService $service, $id)
    {
        $service->update($request->all(), $id);
        return redirect()->back()->with('success', 'Kategori berhasil diubah');
    }

    public function destroy(CategoryService $service, $id)
    {
        $service->delete($id);
        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
