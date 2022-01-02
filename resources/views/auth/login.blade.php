<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	{{-- <link rel="shortcut icon" href="{{ url('img/icons/icon-48x48.png') }}" /> --}}

	<title>Ini Title</title>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row mt-5 pt-5">
            <div class="col-md-4 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-center text-white">Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('auth.login') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <button type="submit" class="form-control btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>