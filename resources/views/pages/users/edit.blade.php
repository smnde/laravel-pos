@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
                <div class="col-md-4 me-auto">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">Edit User</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.update', $user->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" >
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" >
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection