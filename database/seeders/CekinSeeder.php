<?php

namespace Database\Seeders;

use App\Models\Cekin;
use App\Models\Cekout;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CekinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cekin::create([
        //     "user_id" => 1,
        //     "latitude" => "37.78825",
        //     "longitude" => "-122.4324",
        //     "keterangan" => "Late",
        //     "jam" => "Auto Record",
        //     "tanggal" => Carbon::now()->format('Y-m-d')
        // ]);
        Cekin::create([
            "user_id" => 2,
            "latitude" => null,
            "longitude" => null,
            "keterangan" => "Late",
            "jam" => "Auto Record",
            "tanggal" => "2021-11-25"
        ]);
        Cekout::create([
            "user_id" => 2,
            "latitude" => null,
            "longitude" => null,
            "keterangan" => "Late",
            "jam" => "Auto Record",
            "kegiatan" => "Late",
            "tanggal" => "2021-11-25"

        ]);
    }
}
