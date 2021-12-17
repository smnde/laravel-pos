<!-- {{-- @extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 me-auto">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Tambah Hak Akses</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.storePermission') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Hak akses</label>
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
                        <h4 class="text-white">Set Hak Akses</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.setPermission') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab1" data-toggle="tab">Hak Akses</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            @php $i = 1; @endphp
                                            @foreach ($permissions as $row)
                                                <input type="checkbox"
                                                    name="permission[]"
                                                    id="permission"
                                                    class="minimal-red"
                                                    value="{{ $row }}"
                                                    {{ in_array($row, $hasPermission) ? 'checked' : '' }}
                                                > {{ $row }} <br>
                                                @if ($i++ %4 == 0) <br> @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">Set Hak Akses</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}} -->