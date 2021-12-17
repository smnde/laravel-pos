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
	<div class="wrapper">
        {{-- Sidebar --}}
        @include('layouts.sidebar')


		<div class="main">
            {{-- Navbar --}}
            @include('layouts.navbar')

			<main class="content">
				<div class="container-fluid p-0">

                    @yield('content')

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							<p class="mb-0">
								<a href="index.html" class="text-muted"><strong>Crafted by 
									</strong></a> &copy;
									<a class="text-primary" href="https://facebook.com/smndee">
										Ade Usman</a>
							</p>
						</div>
						<div class="col-6 text-right">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-primary" href="https://github.com/smnde">
										<i class="align-middle" data-feather="github"></i>
										Smnde
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/script.js') }}"></script>
</body>

</html>