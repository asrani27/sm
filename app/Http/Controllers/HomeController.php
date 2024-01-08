<?php

namespace App\Http\Controllers;

use App\Models\DPT;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Lurah;
use App\Models\Tpermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function superadmin()
    {
        $kec = Kecamatan::get()->map(function ($item) {
            $item->dpt = DPT::where('kecamatan', $item->nama)->count();
            return $item;
        });

        $kel = Kelurahan::get()->map(function ($item) {
            $item->dpt = DPT::where('kelurahan', $item->nama)->count();
            return $item;
        });

        $dpt = DPT::count();

        return view('admin.home', compact('kec', 'dpt', 'kel'));
    }

    public function user()
    {
        return view('user.home');
    }

    public function pemohon()
    {
        $permohonan = Tpermohonan::orderBy('id', 'DESC')->paginate(15);
        return view('pemohon.home', compact('permohonan'));
    }

    public function updatelurah(Request $request)
    {
        Lurah::first()->update($request->all());
        Session::flash('success', 'Berhasil Diupdate');
        return back();
    }
}
