<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Penerimaan Siswa Baru SMK Manggalatama Cilacap</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body style="background-color: #ffffff">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{route('frontpage')}}"><img src="{{asset('images/logo smk.png')}}" alt="logo" width="36px"> PSB <small>SMK Manggalatama Binangun</small></a>
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#welcome" onclick="$('html, body').animate({scrollTop: $('#welcome').offset().top}, 250);">Beranda <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#majors" onclick="$('html, body').animate({scrollTop: $('#majors').offset().top}, 250);">Jurusan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact" onclick="$('html, body').animate({scrollTop: $('#contact').offset().top}, 250);">Hubungi Kami</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mt-2">
                <div class="container h-100">
                    <div class="row h-100 justify-content-center align-items-center">
                        <div class="col-12 mt-4">
                            <h1 id="welcome" class="mt-2">Selamat datang di Pendaftaran online SMK Manggalatama</h1>
                            <p class="text-muted">Silakan daftar melalui dengan menekan tombol register dibawah ini.</p>
                            <p class="text-muted">Atau jika sudah melakukan pendaftaran dan ingin melengkapi data diri atau melakukan test masuk silakan klik tombol Login</p>
                            @guest
                                <a href="{{route('register')}}" class="btn btn-lg btn-outline-secondary mt-4">Daftar Sekarang</a>
                                <a href="{{route('login')}}" class="btn btn-lg btn-primary mt-4">Login</a>
                            @else
                                <a href="{{route('login')}}" class="btn btn-lg btn-primary mt-4">Masuk Dashboard</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <img src="{{asset('images/smk.jpg')}}" alt="" class="img-fluid" width="100%">
            </div>
        </div>
    </div>
</section>
<div class="clearfix mt-4"></div>
<section id="majors" class="bg-light">
    <div class="container mt-4">
        <div class="row h-100 ">
            <div class="col-12">
                <h1 class="mt-4 text-center">Jurusan</h1>
                <div class="card-deck mt-4 mb-4">

                    @forelse($majors as $major)
                        <div class="card">
                            <div class="card-body text-center p-4">
                                <img class="img-fluid" src="{{$major->logo ? $major->logo : asset('images/logo smk.png')}}" alt="" height="96px" width="96px">
                            </div>

                            <div class="card-body">
                                <a href="{{route('frontpage.major', ['code'=> $major->code])}}"><h4 class="card-title">{{$major->major_name}}</h4></a>
                                <p class="card-text">{{$major->description}}</p>
                            </div>
                        </div>
                    @empty

                        <p>Kosong</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix mt-4"></div>
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTemRKiWi4DUz3jgecmgSZRFpBsvNWGQA-BsfeuQ1oxIUYaJuER" alt="" class="img-fluid">
            </div>
            <div class="col-lg-4">
                <div class="container h-100">
                    <div class="row h-100 justify-content-center align-items-center">
                        <div class="col-12">
                            <h1 class="mt-2">Hubungi Kami</h1>
                            <p><i class="fas fa-building "></i>JL.CITRA WIJAYA NO.2, Pesawahan, Kec. Binangun, Kab. Cilacap Prov. Jawa Tengah</p>
                            <p><i class="fas fa-phone-alt "></i> 0231 12345678</p>
                            <p><i class="fas fa-at "></i> info@email.com</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<hr>
<section>
    <div class="container p-5 text-center">
        <small class="text-muted ">SMK MANGGALATAMA BINANGUN <i class="fa fa-copyright"></i>2019</small>
    </div>
</section>

<script src="{{asset('js/app.js')}}"></script>
</body>

</html>
