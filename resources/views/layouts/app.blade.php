<!DOCTYPE html>
<html lang="en">
<head>
<title>PROCTOR</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="PROCTOR" />

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

	<!-- css files -->
	<link href="{{ asset('css/css_slider.css') }}" type="text/css" rel="stylesheet" media="all"><!-- slider css -->
    <link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
    <link href="{{ asset('css/datatables.min.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css' /><!-- custom css -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"><!-- fontawesome css -->
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet"><!-- fontawesome css -->
	<!-- //css files -->

	<!-- google fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
	<!-- //google fonts -->

</head>
<body>
<header class="py-3">
	<div class="container">
			<div id="logo">
				<h1> <a href="{{route('home')}}"><span class="fa fa-stethoscope" aria-hidden="true"></span> PROCTOR</a></h1>
			</div>
		<!-- nav -->
		<nav class="d-lg-flex">
            <label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
                <input type="checkbox" id="drop" />

                    @guest
                    <div class="login-icon ml-2">
                    <a class="user" href="{{ route('login') }}"> Sign up./Login </a>
                    </div>
                    @else
                    <ul class="menu mt-2 ml-auto">
                    @if (!empty(auth()->user()->role) && auth()->user()->role->name === "doctor")
                    <li class=""><a href="{{url('appointments')}}">Appointments</a></li>
                    <li class=""><a href="{{route('profile')}}">My profile</a></li>
                    @endif
                    
                    @if (!empty(auth()->user()->role) && auth()->user()->role->name === "patient")
                    <li class=""><a href="{{url('appointments')}}">Appointments</a></li>
                    <li class=""><a href="{{url('history')}}">My Medical history</a></li>
                    <li class=""><a href="{{route('patient-profile')}}">My profile</a></li>
                    @endif
                    </ul>
                    
                    {{-- <div class="login-icon ml-2">
                    @if (!empty(Auth::user()->role) && Auth::user()->role->name == 'doctor')
                    <a class="user" href="{{ route('profile') }}"> My account</a>
                    @elseif (!empty(Auth::user()->role) && Auth::user()->role->name == 'patient')
                    <a class="user" href="{{ route('patient-profile') }}"> My account</a>
                    @elseif (empty(Auth::user()->role))
                    <a class="user" href="{{ route('update.role') }}">Update Info</a>
                    @endif
                    </div> --}}
                    @if (empty(Auth::user()->role))
                    <a class="user" href="{{ route('update.role') }}">Update Info</a>
                    @endif
                    <li class="btn btn-link" style="list-style: none;">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }} <i class="fa fa-angle-right"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endguest
                    {{--  <ul class="menu mt-2 ml-auto">
                        <li class="active"><a href="{{route('home')}}">Home</a></li>
                        <li class=""><a href="about.html">About Us</a></li>
                        <li class=""><a href="services.html">Services</a></li>
                        <li class=""><a href="blog.html">Blog</a></li>
                        <li class=""><a href="contact.html">Contact Us</a></li>
                    </ul>  --}}
		</nav>
		<div class="clear"></div>
	</div>
</header>
<!-- //header -->

@yield('content')


<!-- footer -->
<footer class="py-5">
	<div class="container py-sm-3">
		<div class="row footer-grids">
			<div class="col-lg-3 col-sm-6 mb-lg-0 mb-sm-5 mb-4">
				<h4 class="mb-sm-4 mb-3"><span class="fa fa-stethoscope"></span> Proctor</h4>
				<p class="mb-3">Doctors without boundaries</p>
			</div>
		</div>
	</div>
</footer>

<!-- copyright -->
<div class="copyright">
	<div class="container py-4">
		<div class=" text-center">
			<p>© 2019 PROCTOR. All Rights Reserved</p>
		</div>
	</div>
</div>

<!-- move top -->
<div class="move-top text-right">
	<a href="#home" class="move-top">
		<span class="fa fa-angle-up  mb-3" aria-hidden="true"></span>
	</a>
</div>
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{asset('js/datetime_piker.js') }}"></script>
<script>
</script>
</body>
</html>
