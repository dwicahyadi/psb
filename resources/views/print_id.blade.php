<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>CETAK KARTU PESERTA</title>
    <script>
        window.print();
    </script>
</head>
<body>
<table width="600px" border="1px black solid" cellpadding="5" cellspacing="0">
    <tr>
        <td colspan="3" align="center">
            <h4>SMK MANGGALATAMA BINANGKIT</h4>
        </td>
    </tr>
    <tr>
        <td colspan="3" align="center">
            <strong>Kartu Peserta Test Masuk</strong>
        </td>
    </tr>
    <tr>
        <td>User</td>
        <td>: {{$candidate->user->username}}</td>
        <td rowspan="5" width="200px">
            <img src="{{$candidate->photo}}" alt="foto" width="200px">
        </td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>: {{$candidate->full_name}}</td>
    </tr>
    <tr>
        <td>Asal Sekolah</td>
        <td>: {{$candidate->school_origin}}</td>
    </tr>
    <tr>
        <td>Jurusan Dipilih</td>
        <td>: {{$candidate->major->major_name}}</td>
    </tr>
    <tr>
        <td>Jadwal Test</td>
        <td>: {{$candidate->test_schedule}}</td>
    </tr>
</table>
</body>
</html>
