<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    public function index()
    {
        $data = Pendaftar::paginate(10);
        return view('admin.pendaftar.index', compact('data'));
    }
    public function cari()
    {
        $keyword = request()->get('cari');
        $data = Pendaftar::where('nik', 'LIKE', '%' . $keyword . '%')->orWhere('nama', 'LIKE', '%' . $keyword . '%')->paginate(10);
        request()->flash();
        return view('admin.pendaftar.index', compact('data'));
    }
}
