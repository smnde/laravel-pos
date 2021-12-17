@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-4 me-auto">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Tambah Role</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('roles.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Nama Role</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary float-end">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 ms-auto">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">List Role</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('users.edit', $role->id) }}" class="btn btn-sm btn-success">Edit</a>
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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