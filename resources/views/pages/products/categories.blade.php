@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
            @if(auth()->user()->can('tambah barang'))
                <div class="col-md-4 me-auto">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">Tambah Kategori</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('categories.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama kategori</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-8 ms-auto">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">List Kategori</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucwords($category->name) }}</td>
                                        <td>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-success">Edit</a>
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