<?php

namespace App\Console\Commands;

use App\Models\Cekout;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class recordCekout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'record:cekout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record checkout as late';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::all();
        foreach ($user as $us) {
            $cek = Cekout::where([['user_id', $us->id], ['tanggal', '=', Carbon::now()->format('Y-m-d')]])->first();
            if (!$cek) {
                Cekout::create([
                    "user_id" => $us->id,
                    "latitude" => null,
                    "longitude" => null,
                    "keterangan" => "Late",
                    "kegiatan" => "Late",
                    "jam" => "Auto Record",
                    "tanggal" => Carbon::now()->format('Y-m-d')
                ]);
            }
        }

        echo "Success record as late";
    }
}
