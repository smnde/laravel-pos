@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <form action="{{ route('purchases.save') }}" method="post" id="savePurchase">
                        @csrf
                        <div class="card-header bg-primary">
                            <div class="row">
                                <div class="col-md-4 me-auto">
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#productModal">
                                        Cari Barang
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-0">
                                        <input type="text" aria-label="Last name" class="form-control" disabled value="Tanggal : {{ date('d-m-Y') }}">
                                        <input type="text" name="invoice" id="invoice" class="form-control" readonly value="{{ $invoice }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="card-body">
                        <table class="table table-hover text-center">
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
                                            <form action="{{ route('purchases.removeProduct', $item->rowId) }}" method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                        <td>{{ ucwords($item->name) }}</td>
                                        <td>
                                            <form action="{{ route('purchases.decrease', $item->rowId) }}" method="post" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-info">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </form>

                                            <a style="display: inline">{{ $item->qty }}</a>
                                            
                                            <form action="{{ route('purchases.increase', $item->rowId) }}" method="post" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-info">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->subtotal }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="5">Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <td colspan="3">
                                    <form action="{{ route('purchases.clear') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary float-start">Batal</button>
                                    </form>
                                </td>
                                <td colspan="2">
                                    <button class="btn btn-primary float-end" formtarget="#savePurchase">Simpan</button>
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
                                <form action="{{ route('purchases.addProduct', $product->id) }}" method="post">
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
      </div>
    </div>
  </div>

@endsection