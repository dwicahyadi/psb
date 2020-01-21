<!doctype html>
<html lang="en">
<head>
    <title>TEST MASUK</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>
<nav class="sticky-top bg-dark text-white p-4">
    <div class="d-flex justify-content-around">
        <h5>TEST MASUK SMK MAMNGGALATAMA</h5>
        <h5 id="countdown" class="p-2"></h5>
    </div>


</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-9">
            <section id="subjects-picker" class="bg-light">
                <div class="container">
                    <h1>Pilih Mata Pelajaran</h1>
                    <p>Pilih salah satu matapelajaran yang ingin dikerjakan terlebih dahulu. Mata pelajaran yang dipilih harus diseslaikan sebelum memilih mata pelajaran lain.</p>
                    <button type="button" class="btn btn-lg btn-primary btn-block" id="matematika" onclick="pick('Matematika',this.id)">MATEMATIKA</button>
                    <button type="button" class="btn btn-lg btn-primary btn-block" id="bahasa-indonesia" onclick="pick('Bahasa Indonesia',this.id)">BAHASA INDONESIA</button>
                    <button type="button" class="btn btn-lg btn-primary btn-block" id="bahasa-inggris" onclick="pick('Bahasa Inggris',this.id)">BAHASA INGGRIS</button>
                    <button type="button" class="btn btn-lg btn-primary btn-block" id="kewarganegaraan" onclick="pick('Kewarganegaraan',this.id)">KEWARGANEGARAAN</button>
                </div>
            </section>
            <section id="papperwork" class="pt-4">
                <div class="container">
                    <div id="questions">

                    </div>
                </div>

            </section>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body bg-dark text-white">
                    <table class="table text-white">
                        <tr>
                            <td align="center" colspan="2"><img src="{{Auth::user()->candidate->photo}}" alt="foto" class="img-thumbnail" width="150px"></td>
                        </tr>
                        <tr>
                            <td>
                                user
                            </td>
                            <td>
                                {{Auth::user()->username}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nama
                            </td>
                            <td>
                                {{Auth::user()->candidate->full_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Asal Sekolah
                            </td>
                            <td>
                                {{Auth::user()->candidate->school_origin}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jurusan Dipilih
                            </td>
                            <td>
                                {{Auth::user()->candidate->major->major_name}}
                            </td>
                        </tr>
                    </table>
                    <form action="{{route('test.finish')}}" id="formFinish" method="post">
                        @method('post')
                        @csrf
                        <input type="hidden" name="session_id" value="{{request('session_id')}}">
                        <input type="submit" value="Selesai Mengikuti Ujian" class="btn btn-light btn-block btn-lg" onclick="return confirm('Akhiri ujian sekarang?')">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var duration = "{{$test_duration}}:00";
    var interval = setInterval(function() {
        var timer = duration.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) clearInterval(interval);
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        if ((seconds <= 0) && (minutes <= 0))
        {
            clearInterval(interval);
            alert('Waktu habis. Test selesai')
            $('#formFinish').submit();
        }
        $('#countdown').html('Sisa Waktu '+minutes + ':' + seconds);
        duration = minutes + ':' + seconds;
    }, 1000);

    var coba2 = setInterval(function() {
        $.ajax({
            url: "{{route('__checkToken')}}",
            method: "post",
            data: {_token: "{{csrf_token()}}", token:"{{request('session_id')}}",},
            success: function (data) {
                if(!data)
                {
                    alert('hayooo login di yang lain ya')
                }

            }
        })

    }, 1000);

    function pick(subject,id)
    {
        $('#'+id).hide();
        $('#subjects-picker').hide(250)
        $.ajax({
            url: "{{route('__getQuestions')}}",
            method: "get",
            data: {_token: "{{csrf_token()}}", subjects: subject,},
            dataType: "text",
            success: function (questions) {
                $('#questions').html(questions)
            }
        })
    }

    function submitTest()
    {
        $('#submit-test').attr('disabled','disabled');
        $('#submit-test').text('mengirim data..');
        $.ajax({
            url: "{{route('__submitTest')}}",
            method: "post",
            data: $('#form-questions').serialize(),
            dataType: "json",
            success: function (data) {
                alert(data.msg);
                if(data.status == 'success')
                {
                    $('#subjects-picker').show();
                    $('#questions').html('');

                }

            },
            error: function (status, error, data) {
                alert(error + ' Pastikan semua pertanyaan sudah di isi');
                $('#submit-test').removeAttr('disabled');
                $('#submit-test').text('Selesai');
            }
        })
    }


</script>

</body>
</html>
