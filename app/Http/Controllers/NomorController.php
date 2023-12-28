<?php

namespace App\Http\Controllers;

use App\Models\Nomor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class NomorController extends Controller
{
    public function index()
    {
        $data = Nomor::paginate(10);
        return view('admin.nomor.index', compact('data'));
    }

    public function delete($id)
    {
        Nomor::find($id)->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }

    public function deleteAll()
    {
        Nomor::get()->map->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }

    public function upload(Request $req)
    {
        $file = $req->file;
        $type = 'Xlsx';

        $reader = IOFactory::createReader($type);
        $spreadsheet = $reader->load($file);

        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();
        $nomor = [];
        foreach ($data as $i) {
            array_push($nomor, $i[0]);
        }

        //simpan

        foreach ($nomor as $s) {

            $check = Nomor::where('nomor', $s)->first();
            if ($check == null) {
                //save
                $n = new Nomor;
                $n->nomor = $s;
                $n->save();
            } else {
            }
        }

        Session::flash('success', 'berhasil di import');
        return back();
    }
}
