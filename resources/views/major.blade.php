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
                    <a class="nav-link" href="{{route('frontpage')}}#welcome" onclick="$('html, body').animate({scrollTop: $('#welcome').offset().top}, 250);">Beranda <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('frontpage')}}#majors" onclick="$('html, body').animate({scrollTop: $('#majors').offset().top}, 250);">Jurusan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('frontpage')}}#contact" onclick="$('html, body').animate({scrollTop: $('#contact').offset().top}, 250);">Hubungi Kami</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <br>
                <br>
                <div class="text-center">
                    <h1>{{$major->major_name}}</h1>
                    <img src="{{$major->logo ? $major->logo : asset('images/logo smk.png')}}" alt="{{$major->major_name}}" class="img-thumbnail" width="200px">
                    <p>{{$major->description}}</p>
                </div>
                <table class="table table-striped">
                    <tr>
                        <td>Status Pendaftaran</td>
                        <td>{{$major->is_open ? 'Masih Dibuka' : 'Sudah Ditutup'}}</td>
                    </tr>

                    <tr>
                        <td>Jumlah Kelas Dibuka</td>
                        <td>{{$major->class_open}}</td>
                    </tr>

                    <tr>
                        <td>Jumlah Siswa dibutuhkan</td>
                        <td>{{$major->student_per_class*$major->class_open}}</td>
                    </tr>

                    <tr>
                        <td>Jumlah Calon Siswa</td>
                        <td>{{$major->candidates->count()}}</td>
                    </tr>
                </table>
                <hr>
                <a href="{{route('register')}}" class="btn btn-lg btn-outline-secondary btn-block mt-4">Daftar Sekarang</a>
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
