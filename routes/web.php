<?php

use App\Models\Cekin;
use App\Models\Cekout;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/login', function () {
    return view('login');
})->name("login")->middleware("guest");

Route::post('/login', function (Request $request) {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        if (Auth::user()->name == 'Admin') {
            return redirect('/');
        } else {
            Auth::logout();
            return back()->with('pesan', 'Anda bukan admin');
        }
    } else {
        return back()->with('pesan', 'Email atau password Salah');
    }
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {

        $totalKaryawan = User::where('name', '!=', 'Admin')->count();
        $karyawanCekin = Cekin::where('user_id', '!=', 1)->where('tanggal', '=', Carbon::now()->format("Y-m-d"))->where("keterangan", "!=", "Absent")->count();
        $karyawanCekout = Cekout::where('user_id', '!=', 1)->where('tanggal', '=', Carbon::now()->format("Y-m-d"))->where("keterangan", "!=", "Absent")->count();
        $karyawanIzin = Cekout::where('user_id', '!=', 1)->where('tanggal', '=', Carbon::now()->format("Y-m-d"))->where("keterangan", "==", "Absent")->count();

        $user = User::where('name', '!=', 'Admin')->get();

        return view('dashboard', compact('totalKaryawan', 'karyawanCekin', 'karyawanCekout', "user", "karyawanIzin"));
    });

    Route::get("/rekap-absensi", function () {
        $user = User::where('name', '!=', 'Admin')->get();
        return view("rekap_absensi", compact("user"));
    });

    Route::get("/kelola-pengguna", function () {
        $user = User::where('name', '!=', 'Admin')->get();
        return view("kelola_pengguna", compact("user"));
    });

    Route::get('/logout', function () {
        Auth::logout();
        return back();
    });

    Route::post("/daftar", function (Request $request) {
        User::create([
            'foto' => $request->file('foto')->getClientOriginalName(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nip' => $request->nip,
        ]);
        $request->file('foto')->storeAs('public/user', $request->file('foto')->getClientOriginalName());
        return back()->with('pesan', 'Berhasil menambahkan akun user');
    });

    Route::get("/hapus-akun/{user}", function (User $user) {
        $user->delete();
        return back()->with('pesan', 'Berhasil menghapus akun user');
    });
});


Route::get("/migrate", function () {
    Artisan::call('migrate:fresh --seed');
    return back();
});
Route::get("/cekin", function () {
    Artisan::call('record:cekin');
    return back();
});
Route::get("/cekout", function () {
    Artisan::call('record:cekout');
    return back();
});
