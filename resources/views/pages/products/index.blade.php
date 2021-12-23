@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary">
                        <a href="{{ route('products.create') }}" class="btn btn-lg btn-info">Tambah Barang</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped text-center">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Stok</th>
                                    <th>Modal</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ ucwords($product->category->name) }}</td>
                                        <td>{{ Strtoupper($product->code) }}</td>
                                        <td>{{ ucwords($product->name) }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->purchase_price }}</td>
                                        <td>{{ $product->sales_price }}</td>
                                        <td>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-success">Edit</a>
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection