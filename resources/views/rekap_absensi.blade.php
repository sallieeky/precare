<?php 
use Carbon\Carbon;

?>

@extends("base_views.dashboard")
@section("rekap-active", "active")
@section("linkcss")
  <link class="js-stylesheet" href="https://demo.adminkit.io/css/light.css" rel="stylesheet">
@endsection
@section("main")
<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Rekap Karyawan</strong> PRECARE</h1>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Rekap kehadiran bulan ini karyawan PRECARE</h5>
          </div>
          <div class="card-body">
            <table id="datatables-reponsive" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>Foto Profile</th>
                  <th>Nama</th>
                  <th>Total Cekin</th>
                  <th>Total Cekin Terlambat</th>
                  <th>Total Cekout</th>
                  <th>Total Cekout Terlambat</th>
                  <th>Total Izin</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($user as $us)
                <tr>
                  <td><img src="{{ asset("storage/user/" . $us->foto) }}" alt="{{ $us->name }}" style="max-height: 50px" class="img-responsive img-thumbnail"></td>
                  <td>{{ $us->name }}</td>
                  <td>
                      <span>{{ $us->cekin->where("keterangan", "!=", "Absent")->count() }}</span>
                  </td>
                  <td>
                      <span>{{ $us->cekin->where("keterangan", "Late")->count() }}</span>
                  </td>
                  <td>
                      <span>{{ $us->cekout->where("keterangan", "!=", "Absent")->count() }}</span>
                  </td>
                  <td>
                      <span>{{ $us->cekout->where("keterangan", "Late")->count() }}</span>
                  </td>
                  <td>
                    <span>{{ $us->cekout->where("keterangan", "Absent")->count() }}</span>
                  </td>
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

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Datatables Responsive
    $("#datatables-reponsive").DataTable({
      responsive: true
    });
  });
</script>

@endsection