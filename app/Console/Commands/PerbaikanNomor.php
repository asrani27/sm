<?php

namespace App\Console\Commands;

use App\Models\Nomor;
use App\Models\Riwayat;
use Illuminate\Console\Command;

class PerbaikanNomor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'perbaikannomor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $data = Nomor::get();
        $data->map(function ($item) {
            dd($item->nomor);
            $item->nomor = '+62' . substr($item->nomor, 1);
            $item->save();
            return $item;
        });
        $nomor = Riwayat::get();
        $nomor->map(function ($item) {
            $item->telp = '+62' . substr($item->telp, 1);
            $item->save();
            return $item;
        });
    }
}
