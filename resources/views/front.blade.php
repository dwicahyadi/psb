<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>cahyadi2@gmail.com</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body style="background-color: #ffffff">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">PSB <small>SMK MANGGALATAMA BIdsadsadsadNANGUN</small></a>
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#welcome" onclick="$('html, body').animate({scrollTop: $('#welcome').offset().top}, 250);">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#majors" onclick="$('html, body').animate({scrollTop: $('#majors').offset().top}, 250);">Majors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact" onclick="$('html, body').animate({scrollTop: $('#contact').offset().top}, 250);">Contact</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<div class="clearfix mt-4"></div>
<section id="welcome">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="container h-100">
                    <div class="row h-100 justify-content-center align-items-center">
                        <div class="col-12">
                            <h1 class="mt-2">dsadsadsadsadsa</h1>
                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu non sodales neque sodales ut etiam. Et netus et malesuada fames.</p>
                            <a href="{{route('register')}}" class="btn btn-lg btn-outline-secondary mt-4">Register</a>
                            <a href="{{route('login')}}" class="btn btn-lg btn-primary mt-4">Login</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <img src="https://caphe.sfo2.cdn.digitaloceanspaces.com/assets/images/humaaans-7.jpg" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<div class="clearfix mt-4"></div>
<section id="majors" class="bg-light">
    <div class="container mt-4">
        <div class="row h-100 ">
            <div class="col-12">
                <h1 class="mt-4 text-center">Majors</h1>
                <div class="card-columns mt-4">
                    <div class="card">
                        <img class="card-img-top mt-4" src="https://www.campsite.ml/static/webflow/user-login3/images/hero-3.svg" alt="" height="200px">
                        <div class="card-body">
                            <h4 class="card-title">Major 1</h4>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vulputate dignissim suspendisse in est ante in nibh. Lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque habitant. Diam ut venenatis tellus in metus vulputate.</p>
                        </div>
                    </div>

                    <div class="card">
                        <img class="card-img-top mt-4" src="https://www.campsite.ml/static/webflow/user-login3/images/hero-1.svg" alt="" height="200px">
                        <div class="card-body">
                            <h4 class="card-title">Major 2</h4>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vulputate dignissim suspendisse in est ante in nibh. Lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque habitant. Diam ut venenatis tellus in metus vulputate.</p>
                        </div>
                    </div>

                    <div class="card">
                        <img class="card-img-top mt-4" src="https://www.campsite.ml/static/webflow/user-login3/images/hero-2.svg" alt="" height="200px">
                        <div class="card-body">
                            <h4 class="card-title">Major 3</h4>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vulputate dignissim suspendisse in est ante in nibh. Lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque habitant. Diam ut venenatis tellus in metus vulputate.</p>
                        </div>
                    </div>
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
                            <h1 class="mt-2">Contact Us</h1>
                            <p><i class="fas fa-building "></i> Jl. Street name No 47 Cirebon</p>
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
