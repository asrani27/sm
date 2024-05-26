<?php

namespace App\Http\Controllers;

use App\Models\SM;
use App\Models\DPT;
use App\Models\Lurah;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pendaftar;
use App\Models\Tpermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function superadmin()
    {
        // $kec = Kecamatan::get()->map(function ($item) {
        //     $item->dpt = DPT::where('kecamatan', $item->nama)->count();
        //     return $item;
        // });

        // $kel = Kelurahan::get()->map(function ($item) {
        //     $item->dpt = DPT::where('kelurahan', $item->nama)->count();
        //     return $item;
        // });

        // $dpt = DPT::count();
        // $sm = SM::count();

        $kec = [];
        $kel = [];
        $dpt = 0;
        $sm = 0;

        $data = Pendaftar::get()->map(function ($item) {
            $item->dibawai = Pendaftar::where('pendaftar_id', $item->id)->count();
            return $item;
        })->sortByDesc('dibawai');
        return view('admin.home', compact('kec', 'dpt', 'kel', 'sm', 'data'));
    }

    public function user()
    {

        $data = Pendaftar::where('pendaftar_id', Auth::user()->pendaftar->id)->get();

        return view('user.home', compact('data'));
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
