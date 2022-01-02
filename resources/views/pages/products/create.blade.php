@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if(auth()->user()->can('tambah barang'))
                <div class="col-md-10 mx-auto">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">Tambah Barang</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Kategori</label>
                                            <select class="form-control" name="category_id">
                                                <option selected>Kategori</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="code" class="form-label">Kode barang</label>
                                            <input type="text" class="form-control" id="code" name="code" readonly value="{{ $code }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama barang</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Stok</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="0" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="purchase_price" class="form-label">Harga beli</label>
                                            <input type="number" class="form-control" id="purchase_price" name="purchase_price">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sales_price" class="form-label">Harga jual</label>
                                            <input type="number" class="form-control" id="sales_price" name="sales_price">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection