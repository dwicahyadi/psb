<h1>SMK MANGGALATAMA BINANGUN CILACAP</h1>
<h3>Laporan Calon Siswa</h3>
<table class="table table-bordered table-striped" id="dataTable">
    <thead>
    <tr>
        <th>No</th>
        <th>User</th>
        <th>NISN</th>
        <th>Asal Sekolah</th>
        <th>NEM</th>
        <th>Nama Lengkap</th>
        <th>L/P</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Alamat</th>
        <th>Nama Orang Tua/Wali</th>
        <th>Pekerjaan Orang Tua/Wali</th>
        <th>No Telp Orang Tua/Wali</th>
        <th>Jumlah Saudara</th>
        <th>Jurusan</th>
        <th>Kelengkapan Administrasi</th>
        <th>Jadwal Test</th>
        <th>Hasil Test</th>
        <th>Diterima</th>
    </tr>
    </thead>

    <tbody>
    @php($i=1)
    @forelse($candidates as $candidate)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$candidate->user->username}}</td>
            <td>{{$candidate->nisn}}</td>
            <td>{{$candidate->school_origin }}</td>
            <td>{{$candidate->nem }}</td>
            <td>{{$candidate->full_name }}</td>
            <td>{{$candidate->gender }}</td>
            <td>{{$candidate->pob }}</td>
            <td>{{date('d/m/Y', strtotime($candidate->dob)) }}</td>
            <td>{{$candidate->address }}</td>
            <td>{{$candidate->parent_name }}</td>
            <td>{{$candidate->parent_job }}</td>
            <td>{{$candidate->parent_phone }}</td>
            <td>{{$candidate->number_of_siblings }}</td>
            <td>{{$candidate->major->major_name ?? 'Belum dipilih' }}</td>
            <td>@if($candidate->photo && $candidate->skl_file && $candidate->ijazah_file) Ya @endif</td>
            <td>{{$candidate->test_schedule ?? 'Belum ditentukan' }}</td>
            <td>{{$candidate->user->test ? $candidate->user->test->testDetails->sum('score') : 'Belum ikut test' }}</td>
            <td>{{$candidate->be_accepted ? 'Diterima' : '' }}</td>
        </tr>
    @empty

    @endforelse

    </tbody>

</table>
