@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 me-auto">
                {{-- <div class="card">
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
                </div> --}}

                <div class="card">
                    <div class="card-header bg-primary">
                        <button type="button" class="btn btn-info mb-3 btn-lg" data-bs-toggle="modal" data-bs-target="#productModal">
                            Cari Barang
                          </button>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sales.save') }}" method="post">
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="invoice" class="form-label">No struk</label>
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
                        <table class="table table-hover table-stripped text-center">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Nama barang</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>
                                            <form action="{{ route('sales.removeProduct', $item->rowId) }}" method="post">
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
                                        <td colspan="5">Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <td colspan="3">
                                    <form action="{{ route('sales.clear') }}" method="post">
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
  
  <!-- Modal -->
  <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title" id="productModalLabel">List barang</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table table-hover table-stripped text-center">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ ucwords($product->name) }}</td>
                            <td>{{ ucwords($product->category->name) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->purchase_price }}</td>
                            <td>{{ $product->sales_price }}</td>
                            <td>
                                <form action="{{ route('sales.addProduct', $product->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Pilih</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@endsection