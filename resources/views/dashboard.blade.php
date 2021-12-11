<?php 
use Carbon\Carbon;
use App\Models\Absent;

?>

@extends("base_views.dashboard")
@section("dashboard-active", "active")
@section("linkcss")
  <link class="js-stylesheet" href="https://demo.adminkit.io/css/light.css" rel="stylesheet">
@endsection
@section("main")
<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Statistik Harian</strong> PRECARE</h1>
    <div class="row">
      <div class="col-xl-12 col-xxl-12 d-flex">
        <div class="w-100">
          <div class="row">
            <div class="col-sm-3">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col mt-0">
                      <h5 class="card-title">Total Karyawan</h5>
                    </div>
                    <div class="col-auto">
                      <div class="stat text-primary">
                        <i class="align-middle" data-feather="truck"></i>
                      </div>
                    </div>
                  </div>
                  <h4 class="mt-1 mb-3">{{ $totalKaryawan }}</h1>
                  <div class="mb-0">
                    <span class="text-muted"><small>Data di hitung secara otomatis</small></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col mt-0">
                      <h5 class="card-title">Karyawan Check In</h5>
                    </div>
                    <div class="col-auto">
                      <div class="stat text-primary">
                        <i class="align-middle" data-feather="users"></i>
                      </div>
                    </div>
                  </div>
                  <h4 class="mt-1 mb-3">{{ $karyawanCekin }}</h4>
                  <div class="mb-0">
                    <span class="text-muted"><small>Data di hitung secara otomatis</small></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col mt-0">
                      <h5 class="card-title">Karyawan Check Out</h5>
                    </div>
                    <div class="col-auto">
                      <div class="stat text-primary">
                        <i class="align-middle" data-feather="dollar-sign"></i>
                      </div>
                    </div>
                  </div>
                  <h4 class="mt-1 mb-3">{{ $karyawanCekout }}</h4>
                  <div class="mb-0">
                    <span class="text-muted"><small>Data di hitung secara otomatis</small></span>                  
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col mt-0">
                      <h5 class="card-title">Karyawan Izin</h5>
                    </div>
                    <div class="col-auto">
                      <div class="stat text-primary">
                        <i class="align-middle" data-feather="dollar-sign"></i>
                      </div>
                    </div>
                  </div>
                  <h4 class="mt-1 mb-3">{{ $karyawanIzin }}</h4>
                  <div class="mb-0">
                    <span class="text-muted"><small>Data di hitung secara otomatis</small></span>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Daftar check in karyawan</h5>
          </div>
          <div class="card-body">
            <table id="datatables-reponsive" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>Foto Profile</th>
                  <th>Nama</th>
                  <th>Waktu</th>
                  <th>Keterangan</th>
                  <th>Lokasi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($user as $us)
                <tr>
                  <td><img src="{{ asset("storage/user/" . $us->foto) }}" alt="{{ $us->name }}" style="max-height: 50px" class="img-responsive img-thumbnail"></td>
                  <td>{{ $us->name }}</td>
                  <td>
                    @if ($us->cekin->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("jam")->first() == null)
                      <span>Belum Check In</span>
                    @else
                      <span>{{ $us->cekin->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("jam")->first() }}</span>
                    @endif
                  </td>
                  <td>
                    @if ($us->cekin->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("keterangan")->first() == null)
                    <span>Belum Check In</span>
                    @elseif ($us->cekin->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("keterangan")->first() == "Absent")
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $us->id }}">Detail Izin</button><span></span>
                    @else
                      <span>{{ $us->cekin->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("keterangan")->first() }}</span>
                    @endif
                  </td>
                  <td>
                    @if ($us->cekin->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("keterangan")->first() == null)
                    Tidak Tersedia
                    @elseif ($us->cekin->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("keterangan")->first() == "Absent")
                    Tidak Tersedia
                    @else
                    <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ $us->cekin->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("latitude")->first() }},{{ $us->cekin->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("longitude")->first() }}" class="btn btn-outline-info ">Lihat Lokasi</a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Daftar check out karyawan</h5>
          </div>
          <div class="card-body">
            <table id="datatables-reponsive-2" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>Foto Profile</th>
                  <th>Nama</th>
                  <th>Waktu</th>
                  <th>Keterangan</th>
                  <th>Kegiatan</th>
                  <th>Lokasi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($user as $us)
                <tr>
                  <td><img src="{{ asset("storage/user/" . $us->foto) }}" alt="{{ $us->name }}" style="max-height: 50px" class="img-responsive img-thumbnail"></td>
                  <td>{{ $us->name }}</td>
                  <td>
                    @if ($us->cekout->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("jam")->first() == null)
                      <span>Belum Check Out</span>
                    @else
                      <span>{{ $us->cekout->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("jam")->first() }}</span>
                    @endif
                  </td>
                  <td>
                    @if ($us->cekout->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("keterangan")->first() == null)
                      <span>Belum Check Out</span>
                    @else
                      <span>{{ $us->cekout->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("keterangan")->first() }}</span>
                    @endif
                  </td>
                  <td>
                    @if ($us->cekout->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("kegiatan")->first() == null)
                      <span>Belum Check Out</span>
                    @else
                      <span>{{ $us->cekout->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("kegiatan")->first() }}</span>
                    @endif
                  </td>
                  <td>
                    @if ($us->cekout->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("jam")->first() == null)
                    Tidak Tersedia
                    @else
                    <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ $us->cekout->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("latitude")->first() }},{{ $us->cekout->where("tanggal", Carbon::now()->format("Y-m-d"))->pluck("longitude")->first() }}" class="btn btn-outline-info ">Lihat Lokasi</a>
                    @endif
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


<!-- Modal -->
@foreach (Absent::where("tanggal", Carbon::now()->format("Y-m-d"))->get() as $as)
<div class="modal fade" id="staticBackdrop-{{ $as->user_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Detail Izin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>Jenis Izin</h5>
        <span>{{ $as->tipe }}</span>
        <h5>Keterangan Izin</h5>
        <span>{{ $as->keterangan }}</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endforeach


<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Datatables Responsive
    $("#datatables-reponsive").DataTable({
      responsive: true
    });
    $("#datatables-reponsive-2").DataTable({
      responsive: true
    });
  });
</script>

@endsection