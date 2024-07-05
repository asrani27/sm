<?php

namespace App\Console\Commands;

use App\Models\DPT;
use App\Models\FileDpt;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DptCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generatedpt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncron DPT';

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

        $path = base_path('public/assets/barat2.xlsx');
        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        dd($data);
        $kecamatan = str_replace(': ', '', $data[3][7]);
        $kelurahan = str_replace(': ', '', $data[4][7]);
        $tps = str_replace(': ', '', $data[5][7]);
        $data_dpt = array_slice($data, 8);

        dd($data_dpt);
        //simpan DPT
        foreach ($data_dpt as $key => $item) {
            $check = DPT::where('nama', $item[1])
                ->where('jkel', $item[2])
                ->where('usia', $item[3])
                ->where('kelurahan', $item[4])
                ->where('rt', $item[5])
                ->where('rw', $item[6])
                ->first();

            if ($check == null) {
                if ($item[1] == null) {
                } else {
                    $n = new DPT;
                    $n->nama = $item[1];
                    $n->jkel = $item[2];
                    $n->usia = $item[3];
                    $n->kelurahan = $item[4];
                    $n->rt = $item[5];
                    $n->rw = $item[6];
                    $n->tps = $tps;
                    $n->kecamatan = $kecamatan;
                    $n->save();
                }
            } else {
            }
        }
    }
}
