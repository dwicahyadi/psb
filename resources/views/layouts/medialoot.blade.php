<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--    <link rel="icon" href="images/favicon.ico">--}}
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link href="{{asset('css/font-awesome.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('dataTables/datatables.min.css')}}"/>

</head>
<body id="app">
<div class="container-fluid" id="wrapper">
    <div class="row">
        <nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
            <h1 class="site-title text-center"><a href="{{route('dashboard')}}"><img src="{{asset('images/logo smk.png')}}" alt="logo" width="48px"><br> SMK MANGGALATAMA BINAGUN CILACAP</a></h1>
            <li class="dropdown-divider"></li>
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
            <ul class="nav nav-pills flex-column sidebar-nav">
                <li class="nav-item"><a class="nav-link @if(request()->is('admin/dashboard*')) active @endif" href="{{route('dashboard')}}"><em class="fa fa-dashboard"></em>Dashboard</a></li>
                @can('manage users')
                    <li class="nav-item"><a class="nav-link  @if(request()->is('admin/user*')) active @endif" href="{{route('user.index')}}"><em class="fa fa-key"></em> Users</a></li>
                @endcan
                @can('manage data')
                    <li class="nav-item"><a class="nav-link @if(request()->is('admin/major*')) active @endif" href="{{route('major.index')}}"><em class="fa fa-wrench"></em> Jurusan</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->is('admin/question*')) active @endif" href="{{route('question.index')}}"><em class="fa fa-pencil"></em> Soal</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->is('admin/candidate*')) active @endif" href="{{route('candidate.index')}}"><em class="fa fa-users"></em> Calon Siswa</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->is('admin/test/result*')) active @endif" href="{{route('test.results')}}"><em class="fa fa-bookmark"></em> Hasil Test</a></li>
                @endcan
                @can('view reports')
                    <li class="nav-item"><a class="nav-link @if(request()->is('admin/report*')) active @endif" href="{{route('candidate.report')}}"><em class="fa fa-bar-chart-o"></em> Laporan</a></li>
                @endcan
                <li class="dropdown-divider"></li>
                @can('manage data')
                    <li class="nav-item"><a class="nav-link @if(request()->is('settings*')) active @endif" href="{{route('settings')}}"><em class="fa fa-cogs"></em> Pengaturan</a></li>
                @endcan
            </ul>

            <a class="logout-button"  href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><em class="fa fa-power-off"></em> Signout</a></nav>
        <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto" id="app">
            <header class="page-header row justify-center">
                <div class="col-md-6 col-lg-8" >
                    <h1 class="float-left text-center text-md-left">@yield('title')</h1>
                </div>
                @guest

                @else
                    <div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="circle float-left profile-photo" width="50" height="auto">
                                <i class="fa fa-user fa-3x"></i>
                            </div>
                            <div class="username mt-1">
                                <h4 class="mb-1">{{ Auth::user()->name }} </h4>
                                <h6 class="text-muted">{{ Auth::user()->role }} </h6>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{route('user.editPassword')}}"><em class="fa fa-lock mr-1"></em> Ganti Password</a>
                            <a class="dropdown-item"  href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><em class="fa fa-power-off mr-1"></em> Logout</a>
                        </div>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest


                <div class="clear"></div>
            </header>
            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('js/app.js')}}"></script>

<script src="{{asset('js/chart.min.js') }}"></script>
<script src="{{asset('js/chart-data.js') }}"></script>
<script src="{{asset('js/easypiechart.js') }}"></script>
<script src="{{asset('js/easypiechart-data.js') }}"></script>
<script src="{{asset('js/bootstrap-datepicker.js') }}"></script>
<script src="{{asset('js/custom.js') }}"></script>
<script type="text/javascript" src="{{asset('dataTables/datatables.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

@yield('script')
</body>
</html>
