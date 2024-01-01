<?php

namespace App\Http\Controllers;

use App\Models\DPT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DPTController extends Controller
{
    public function index()
    {
        $data = DPT::orderBy('id', 'DESC')->paginate(10);
        return view('admin.dpt.index', compact('data'));
    }
    public function upload(Request $req)
    {
        //dd($req->all());
        $file = $req->file;
        $type = 'Xlsx';

        foreach ($file as $key => $f) {

            $reader = IOFactory::createReader($type);
            $spreadsheet = $reader->load($f);

            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();

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

        Session::flash('success', 'berhasil di import');
        return back();
    }
    public function deleteAll()
    {
        DPT::get()->map->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }
}
