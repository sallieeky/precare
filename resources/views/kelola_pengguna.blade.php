<?php 
use Carbon\Carbon;

?>

@extends("base_views.dashboard")
@section("kelola-active", "active")
@section("linkcss")
  <link class="js-stylesheet" href="https://demo.adminkit.io/css/light.css" rel="stylesheet">
@endsection
@section("main")
<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Rekap Akun Karyawan</strong> PRECARE</h1>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Rekap kehadiran bulan ini karyawan PRECARE</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah akun</button>
          </div>
          <div class="card-body">
            <table id="datatables-reponsive" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>Foto Profile</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>NIP</th>
                  <th>Nomor Telepon</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($user as $us)
                <tr>
                  <td><img src="{{ asset("storage/user/" . $us->foto) }}" alt="{{ $us->name }}" style="max-height: 50px" class="img-responsive img-thumbnail"></td>
                  <td>{{ $us->name }}</td>
                  <td>{{ $us->email }}</td>
                  <td>{{ $us->nip }}</td>
                  <td>{{ $us->no_telp }}</td>
                  <td>{{ $us->alamat }}</td>
                  <td><a href="/hapus-akun/{{ $us->id }}" class="btn btn-danger">Hapus Akun</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/daftar" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="foto" class="form-label">Pilih Foto</label>
            <input type="file" accept="image/*" required class="form-control" name="foto" id="foto" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" required class="form-control" name="name" id="nama" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" required class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" required class="form-control" name="password" id="exampleInputPassword1">
          </div>
          <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" required class="form-control" name="nip" id="nip" aria-describedby="emailHelp">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Daftar</button>
      </form>
      </div>
    </div>
  </div>
</div>

@if (session("pesan"))
<div class="notyf" style="justify-content: flex-end; align-items: flex-end;"><div id="notify-custom" class="notyf__toast notyf__toast--lower"><div class="notyf__wrapper"><div class="notyf__icon"><i class="notyf__icon--success" style="color: rgb(59, 125, 221);"></i></div><div class="notyf__message">{{ session("pesan") }}</div></div><div class="notyf__ripple" style="background: rgb(59, 125, 221);"></div></div></div>
@endif

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Datatables Responsive
    $("#datatables-reponsive").DataTable({
      responsive: true
    });

    const notify = document.getElementById("notify-custom")
      setTimeout(() => {
        notify.classList.add("notyf__toast--disappear")
      }, 7500)
  });
</script>

@endsection