@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-5 me-auto">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Barang</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <th>Nama</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <form action="{{ route('orders.addProduct', $product->id) }}" method="post">
                                        @csrf
                                        <tr>
                                            <td>{{ ucwords($product->name) }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-7 ms-auto">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Keranjang</h4>
                    </div>
                    <form action="{{ route('orders.save') }}" id="saveOrders" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="invoice" class="form-label">Invoice</label>
                                        <input type="text" name="invoice" id="invoice" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Tanggal</label>
                                        <input type="text" name="date" id="date" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover">
                            <thead>
                                <th>Aksi</th>
                                <th>Nama</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>
                                            <form action="{{ route('orders.removeProduct', $item->rowId) }}" method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                        <td>{{ ucwords($item->name) }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->qty * $item->price }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="5">Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <td colspan="3">
                                    <form action="{{ route('orders.clear') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary float-start">Batal</button>
                                    </form>
                                </td>
                                <td colspan="2">
                                    <button class="btn btn-primary float-end">Simpan</button>
                                </td>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection