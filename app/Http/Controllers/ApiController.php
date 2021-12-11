<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Cekin;
use App\Models\Cekout;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $data = [
                "status" => "berhasil",
                "data" => Auth::user()
            ];
        } else {
            $data = [
                "status" => "gagal",
                "data" => null
            ];
        }
        return response()->json($data);
    }

    public function getUserData(User $user)
    {
        return response()->json($user);
    }


    public function getUserCekinCekout(User $user)
    {
        $cekin = Cekin::where([['user_id', "=", $user->id], ["tanggal", "=", Carbon::now()->format("Y-m-d")]])->first();
        $cekout = Cekout::where([['user_id', "=", $user->id], ["tanggal", "=", Carbon::now()->format("Y-m-d")]])->first();
        $data = [
            "status" => "berhasil",
            "user" => $user,
            "data" => [
                "cekin" => $cekin,
                "cekout" => $cekout
            ]
        ];
        return response()->json($data);
    }

    public function editAlamat(Request $request)
    {
        User::find($request->id)
            ->update([
                "alamat" => $request->alamat
            ]);

        $data = [
            "status" => "berhasil",
            "alamat" => $request->alamat
        ];

        return response()->json($data);
    }

    public function editNoTelp(Request $request)
    {
        User::find($request->id)
            ->update([
                "no_telp" => $request->no_telp
            ]);

        $data = [
            "status" => "berhasil",
            "no_telp" => $request->no_telp
        ];

        return response()->json($data);
    }

    public function cekin(Request $request)
    {
        // Cek apakah jam 7:30 - 08:30
        if (Carbon::now()->format("H:i") >= "07:30" && Carbon::now()->format("H:i") <= "23:30") {
            // cekek apakah user sudah cekin
            $cek = Cekin::where([['user_id', "=", $request->user_id], ["tanggal", "=", Carbon::now()->format("Y-m-d")]])->first();
            if ($cek) {
                $data = [
                    "status" => "gagal",
                    "keterangan" => "You allready checkin",
                    "data" => null
                ];
            } else {
                Cekin::create([
                    "user_id" => $request->user_id,
                    "keterangan" => "On Time",
                    "jam" => Carbon::now()->format("H:i:s"),
                    "tanggal" => Carbon::now()->format("Y-m-d"),
                    "latitude" => $request->latitude,
                    "longitude" => $request->longitude
                ]);
                $data = [
                    "status" => "berhasil",
                    "keterangan" => "Success checkin",
                    "data" => [
                        "user_id" => $request->user_id,
                        "keterangan" => "On Time",
                        "tanggal" => Carbon::now()->format("Y-m-d"),
                        "latitude" => $request->latitude,
                        "longitude" => $request->longitude
                    ]
                ];
            }
        } else {
            $data = [
                "status" => "gagal",
                "keterangan" => "You can't checkin now",
                "data" => null
            ];
        }
        return response()->json($data);
    }

    public function cekout(Request $request)
    {
        // Cek apakah jam 7:30 - 08:30
        if (Carbon::now()->format("H:i") >= "08:30" && Carbon::now()->format("H:i") <= "23:30") {
            // cekek apakah user sudah cekout
            $cek = Cekout::where([['user_id', "=", $request->user_id], ["tanggal", "=", Carbon::now()->format("Y-m-d")]])->first();
            if ($cek) {
                $data = [
                    "status" => "gagal",
                    "keterangan" => "You allready checkout",
                    "data" => null
                ];
            } else {
                Cekout::create([
                    "user_id" => $request->user_id,
                    "keterangan" => "On Time",
                    "jam" => Carbon::now()->format("H:i:s"),
                    "tanggal" => Carbon::now()->format("Y-m-d"),
                    "latitude" => $request->latitude,
                    "longitude" => $request->longitude,
                    "kegiatan" => $request->kegiatan
                ]);
                $data = [
                    "status" => "berhasil",
                    "keterangan" => "Success checkout",
                    "data" => [
                        "user_id" => $request->user_id,
                        "keterangan" => "On Time",
                        "tanggal" => Carbon::now()->format("Y-m-d"),
                        "latitude" => $request->latitude,
                        "longitude" => $request->longitude
                    ]
                ];
            }
        } else {
            $data = [
                "status" => "gagal",
                "keterangan" => "You can't checkout now",
                "data" => null
            ];
        }
        return response()->json($data);
    }

    public function getCekinStatus(User $user)
    {
        $cekin = Cekin::where([['user_id', "=", $user->id], ["tanggal", "=", Carbon::now()->format("Y-m-d")]])->first();
        if ($cekin) {
            $data = [
                "status" => "berhasil",
                "user" => $user,
                "data" => $cekin,
                "waktu" => $cekin->jam . " ($cekin->keterangan)"
            ];
        } else {
            $data = [
                "status" => "gagal",
                "user" => $user,
                "data" => null,
                "waktu" => null
            ];
        }
        return response()->json($data);
    }

    public function getCekoutStatus(User $user)
    {
        $cekout = Cekout::where([['user_id', "=", $user->id], ["tanggal", "=", Carbon::now()->format("Y-m-d")]])->first();
        if ($cekout) {
            $data = [
                "status" => "berhasil",
                "user" => $user,
                "data" => $cekout,
                "waktu" => $cekout->jam . " ($cekout->keterangan)"
            ];
        } else {
            $data = [
                "status" => "gagal",
                "user" => $user,
                "data" => null,
                "waktu" => null
            ];
        }
        return response()->json($data);
    }

    public function absent(Request $request)
    {
        $cek = Absent::where([["tanggal", "=", $request->tanggal], ["user_id", "=", $request->user_id]])->first();
        if ($cek) {
            $data = [
                "status" => "gagal",
                "keterangan" => "You allready absent",
                "data" => null
            ];
        } else {
            Absent::create([
                "user_id" => $request->user_id,
                "tipe" => $request->tipe,
                "keterangan" => $request->keterangan,
                "tanggal" => $request->tanggal
            ]);
            Cekin::create([
                "user_id" => $request->user_id,
                "keterangan" => "Absent",
                "jam" => "Auto Record",
                "tanggal" => $request->tanggal,
                "latitude" => null,
                "longitude" => null
            ]);
            Cekout::create([
                "user_id" => $request->user_id,
                "keterangan" => "Absent",
                "jam" => "Auto Record",
                "tanggal" => $request->tanggal,
                "kegiatan" => "Absent",
                "latitude" => null,
                "longitude" => null
            ]);
            $data = [
                "status" => "berhasil",
                "keterangan" => "Success absent",
                "data" => [
                    "user_id" => $request->user_id,
                    "keterangan" => $request->keterangan,
                    "tanggal" => $request->tanggal
                ]
            ];
        }

        return response()->json($data);
    }

    public function report(User $user)
    {
        $data = [
            "status" => "berhasil",
            "data" => [
                "cekin" => $user->cekin,
                "cekout" => $user->cekout,
            ]
        ];
        return response()->json($data);
    }
}
