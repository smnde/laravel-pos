@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if(auth()->user()->can('edit barang'))
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">Edit Barang</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.update', $product->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="category_id">Kategori</label>
                                    <select class="form-control" name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode barang</label>
                                    <input type="text" class="form-control" id="code" name="code" value="{{ $product->code}}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama barang</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga jual</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection