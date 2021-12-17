@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-5 me-auto">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Tambah hak akses</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.storePermission') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Hak Akses</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary float-end">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 ms-auto">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Set Hak Akses</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.permissions') }}" method="get">
                            <div class="mb-3">
                                <label for="role">Role</label>
                                <div class="input-group mb-3">
                                    <select name="role" id="role" class="form-control">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                    {{ request()->get('role') == $role ? 'selected' : '' }}
                                            >{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-danger">Cek</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                        @if (!empty($permissions))
                            <form action="{{ route('users.setPermission', request()->get('role')) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab1" data-toggle="tab">Hak akses</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab1">
                                                @php $i = 1; @endphp
                                                @foreach ($permissions as $permission => $row)
                                                    <input type="checkbox" name="permission[]" class="minimal-red"
                                                        value="{{ $row }}"
                                                        {{ in_array($row, $hasPermission) ? 'checked' : '' }}
                                                    > {{ $row }} <br>
                                                    @if($i++ % 3 == 0) <br> @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary btn-sm float-end">Set</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection