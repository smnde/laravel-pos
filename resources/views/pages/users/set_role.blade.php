@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Set Role</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.setRole', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <table class="table table-table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td>:</td>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th>Role</th>
                                        <td>:</td>
                                        <td>
                                            @foreach ($roles as $role)
                                                <input type="radio" name="role" id="role" {{ $user->hasRole($role) ? 'checked' : '' }} value="{{ $role}}"> {{ $role }} <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection