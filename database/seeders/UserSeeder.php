<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Admin",
            'foto' => "inspace.png",
            "nip" => "123456789012",
            "email" => "admin@admin",
            "password" => bcrypt("admin12345"),
            'no_telp' => "081243942304",
            'alamat' => "Jl. Ahmad Yani"
        ]);
        User::create([
            "name" => "eky",
            'foto' => "inspace.png",
            "nip" => "123456789012",
            "email" => "eky@admin",
            "password" => bcrypt("eky12345"),
            'no_telp' => "081243942304",
            'alamat' => "Jl. Ahmad Yani"
        ]);
        User::create([
            "name" => "Jeanth",
            'foto' => "jae.jpg",
            "nip" => "123456789012",
            "email" => "jae@precare.com",
            "password" => bcrypt("jaenet123"),
            'no_telp' => "081243942304",
            'alamat' => "Jl. Ahmad Yani"
        ]);
        User::create([
            "name" => "Sallie Mansurina",
            'foto' => "GNRM.png",
            "nip" => "101910772044",
            "email" => "sallie@precare.com",
            "password" => bcrypt("eky12345"),
            'no_telp' => "081243942304",
            'alamat' => "Jl. Ahmad Yani, Gg. Selat Timor"
        ]);
        User::create([
            "name" => "Nabillah Alda",
            'foto' => "logo_precare.png",
            "nip" => "101910610000",
            "email" => "nabillah@precare.com",
            "password" => bcrypt("12345678"),
            'no_telp' => "081234567890",
            'alamat' => "Jl. Rumahku"
        ]);
        User::create([
            "name" => "Rizal R.",
            'foto' => "logo_precare.png",
            "nip" => "101810530000",
            "email" => "rizal@precare.com",
            "password" => bcrypt("12345678"),
            'no_telp' => "081234567890",
            'alamat' => "Jl. Rumahkur"
        ]);
        User::create([
            "name" => "Christina Wulandari",
            'foto' => "logo_precare.png",
            "nip" => "101910190000",
            "email" => "christina@precare.com",
            "password" => bcrypt("12345678"),
            'no_telp' => "081234567890",
            'alamat' => "Jl. Rumahkur"
        ]);
        User::create([
            "name" => "Feriyanto",
            'foto' => "logo_precare.png",
            "nip" => "101910310000",
            "email" => "feri@precare.com",
            "password" => bcrypt("12345678"),
            'no_telp' => "081234567890",
            'alamat' => "Jl. Rumahkur"
        ]);
        User::create([
            "name" => "Rizka P.",
            'foto' => "logo_precare.png",
            "nip" => "101910750000",
            "email" => "rizka@precare.com",
            "password" => bcrypt("12345678"),
            'no_telp' => "081234567890",
            'alamat' => "Jl. Rumahkur"
        ]);
    }
}
