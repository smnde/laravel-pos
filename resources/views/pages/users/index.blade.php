@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
            @if(auth()->user()->can('tambah barang'))
                <div class="col-md-4 me-auto">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">Tambah User</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>                            
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
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
                        <h4 class="text-white">List User</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped text-center">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            @foreach ($user->getRoleNames() as $role)
                                                <label for="role" class="badge bg-success">{{ $role }}</label>
                                            @endforeach
                                        </td>
                                        <td>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @role('admin')
                                                    <a href="{{ route('users.roles', $user->id) }}" class="btn btn-sm btn-info">Set Role</a>
                                                @endrole
                                                @if(auth()->user()->can('edit user'))
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-success">Edit</a>
                                                @endif
                                                @if(auth()->user()->can('hapus user'))
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                @endif
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