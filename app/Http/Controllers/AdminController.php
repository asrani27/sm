<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kasi;
use App\Models\Role;
use App\Models\User;
use App\Models\Arsip;
use App\Models\Surat;
use App\Models\Kepala;
use App\Models\Petugas;
use App\Models\Kategori;
use App\Models\Penyedia;
use App\Models\Registrasi;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function user()
    {
        $data = User::orderBy('id', 'DESC')->paginate(15);
        return view('admin.user.index', compact('data'));
    }
    public function user_create()
    {
        return view('admin.user.create');
    }
    public function user_edit($id)
    {
        $data = User::find($id);
        return view('admin.user.edit', compact('data'));
    }
    public function user_delete($id)
    {
        if (Auth::user()->id == $id) {
            Session::flash('error', 'Tidak bisa di hapus, karena sedang digunakan');
            return back();
        } else {
            $data = User::find($id)->delete();
            Session::flash('success', 'Berhasil Dihapus');
            return back();
        }
    }
    public function user_store(Request $req)
    {
        $checkUser = User::where('username', $req->username)->first();
        $role = Role::where('name', 'superadmin')->first();
        if ($checkUser == null) {
            if ($req->password1 != $req->password2) {
                Session::flash('error', 'Password Tidak Sama');
                return back();
            } else {

                $n = new User();
                $n->name = $req->name;
                $n->username = $req->username;
                $n->password = bcrypt($req->password1);
                $n->save();

                $n->roles()->attach($role);
                Session::flash('success', 'Berhasil Disimpan, Password : ' . $req->password1);
                return redirect('/superadmin/user');
            }
        } else {
            Session::flash('error', 'Username ini sudah pernah di input');
            return back();
        }
    }
    public function user_update(Request $req, $id)
    {
        $data = User::find($id);
        if ($req->password1 == null) {
            //update tanpa password
            $data->name = $req->name;
            $data->save();
            Session::flash('success', 'Berhasil Diupdate');
            return redirect('/superadmin/user');
        } else {
            // update beserta password
            if ($req->password1 != $req->password2) {
                Session::flash('error', 'Password Tidak Sama');
                return back();
            } else {
                $data->password = bcrypt($req->password1);
                $data->name = $req->name;
                $data->save();
                Session::flash('success', 'Berhasil Diupdate, password : ' . $req->password1);
                return redirect('/superadmin/user');
            }
        }
    }

    public function kategori()
    {
        $data = Kategori::orderBy('id', 'DESC')->paginate(15);
        return view('admin.kategori.index', compact('data'));
    }
    public function kategori_create()
    {
        return view('admin.kategori.create');
    }
    public function kategori_edit($id)
    {
        $data = Kategori::find($id);
        return view('admin.kategori.edit', compact('data'));
    }
    public function kategori_delete($id)
    {
        $data = Kategori::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function kategori_store(Request $req)
    {
        $check = Kategori::where('nama', $req->nama)->first();
        if ($check == null) {
            $n = new Kategori();
            $n->nama = $req->nama;
            $n->save();

            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/kategori');
        } else {
            Session::flash('error', 'Kategori ini sudah pernah di input');
            return back();
        }
    }
    public function kategori_update(Request $req, $id)
    {
        $data = Kategori::find($id);
        $data->nama = $req->nama;
        $data->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/kategori');
    }


    public function petugas()
    {
        $data = Petugas::orderBy('id', 'DESC')->paginate(15);
        return view('admin.petugas.index', compact('data'));
    }
    public function petugas_create()
    {
        return view('admin.petugas.create');
    }
    public function petugas_edit($id)
    {
        $data = Petugas::find($id);
        return view('admin.petugas.edit', compact('data'));
    }
    public function petugas_delete($id)
    {
        $data = Petugas::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function petugas_store(Request $req)
    {
        Petugas::create($req->all());
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/superadmin/petugas');
    }
    public function petugas_update(Request $req, $id)
    {
        Petugas::find($id)->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/petugas');
    }

    public function surat()
    {
        $data = Surat::orderBy('id', 'DESC')->paginate(15);
        return view('admin.surat.index', compact('data'));
    }
    public function surat_create()
    {
        $pemeriksaan = Pemeriksaan::get();
        return view('admin.surat.create', compact('pemeriksaan'));
    }
    public function surat_edit($id)
    {
        $data = Surat::find($id);
        $pemeriksaan = Pemeriksaan::get();
        return view('admin.surat.edit', compact('data', 'pemeriksaan'));
    }
    public function surat_delete($id)
    {
        $data = Surat::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function surat_store(Request $req)
    {
        Surat::create($req->all());
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/superadmin/surat');
    }
    public function surat_update(Request $req, $id)
    {
        Surat::find($id)->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/surat');
    }


    public function pemeriksaan()
    {
        $data = Pemeriksaan::orderBy('id', 'DESC')->paginate(15);
        return view('admin.pemeriksaan.index', compact('data'));
    }
    public function pemeriksaan_create()
    {
        $data = Registrasi::paginate(15);
        return view('admin.pemeriksaan.create', compact('data'));
    }

    public function pemeriksaan_create2($id)
    {

        if (Pemeriksaan::count() == 0) {
            $no_pem = 1;
        } else {
            $no_pem = Pemeriksaan::latest()->first()->id + 1;
        }

        $petugas = Petugas::get();
        $registrasi = Registrasi::find($id);
        return view('admin.pemeriksaan.create2', compact('registrasi', 'no_pem', 'petugas'));
    }
    public function pemeriksaan_edit($id)
    {
        $data = Pemeriksaan::find($id);
        $petugas = Petugas::get();
        return view('admin.pemeriksaan.edit', compact('data', 'petugas'));
    }
    public function pemeriksaan_delete($id)
    {
        $data = Pemeriksaan::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function pemeriksaan_store(Request $req)
    {
        //dd($req->all());
        if ($req->uji_peralatan == 'LULUS') {
            $uji1 = 1;
        } else {
            $uji1 = 0;
        }

        if ($req->uji_penerangan == 'LULUS') {
            $uji2 = 1;
        } else {
            $uji2 = 0;
        }

        if ($req->uji_kemudi == 'LULUS') {
            $uji3 = 1;
        } else {
            $uji3 = 0;
        }

        if ($req->uji_chasis == 'LULUS') {
            $uji4 = 1;
        } else {
            $uji4 = 0;
        }

        if ($req->uji_rangka == 'LULUS') {
            $uji5 = 1;
        } else {
            $uji5 = 0;
        }

        if ($req->uji_rem == 'LULUS') {
            $uji6 = 1;
        } else {
            $uji6 = 0;
        }

        if ($req->uji_mesin == 'LULUS') {
            $uji7 = 1;
        } else {
            $uji7 = 0;
        }

        $hasiluji = $uji1 + $uji2 + $uji3 + $uji4 + $uji5 + $uji6 + $uji7;
        if ($hasiluji > 3) {
            $hasil = 'LULUS';
        } else {
            $hasil = "TIDAK LULUS";
        }
        $param = $req->all();
        $param['hasil'] = $hasil;
        $param['registrasi_id'] = Registrasi::where('nomor_reg', $req->registrasi_id)->first()->id;
        //dd($req->all(), $param);

        Pemeriksaan::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/superadmin/pemeriksaan');
    }
    public function pemeriksaan_update(Request $req, $id)
    {
        if ($req->uji_peralatan == 'LULUS') {
            $uji1 = 1;
        } else {
            $uji1 = 0;
        }

        if ($req->uji_penerangan == 'LULUS') {
            $uji2 = 1;
        } else {
            $uji2 = 0;
        }

        if ($req->uji_kemudi == 'LULUS') {
            $uji3 = 1;
        } else {
            $uji3 = 0;
        }

        if ($req->uji_chasis == 'LULUS') {
            $uji4 = 1;
        } else {
            $uji4 = 0;
        }

        if ($req->uji_rangka == 'LULUS') {
            $uji5 = 1;
        } else {
            $uji5 = 0;
        }

        if ($req->uji_rem == 'LULUS') {
            $uji6 = 1;
        } else {
            $uji6 = 0;
        }

        if ($req->uji_mesin == 'LULUS') {
            $uji7 = 1;
        } else {
            $uji7 = 0;
        }

        $hasiluji = $uji1 + $uji2 + $uji3 + $uji4 + $uji5 + $uji6 + $uji7;
        if ($hasiluji > 3) {
            $hasil = 'LULUS';
        } else {
            $hasil = "TIDAK LULUS";
        }

        $u = Pemeriksaan::find($id);
        $u->uji_peralatan = $req->uji_peralatan;
        $u->uji_penerangan = $req->uji_penerangan;
        $u->uji_kemudi = $req->uji_kemudi;
        $u->uji_chasis = $req->uji_chasis;
        $u->uji_rangka = $req->uji_rangka;
        $u->uji_rem = $req->uji_rem;
        $u->uji_mesin = $req->uji_mesin;
        $u->hasil = $hasil;
        $u->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/pemeriksaan');
    }

    public function registrasi()
    {
        $data = Registrasi::orderBy('id', 'DESC')->paginate(15);
        return view('admin.registrasi.index', compact('data'));
    }
    public function registrasi_create()
    {
        $jenis = Kategori::get();

        if (Registrasi::count() == 0) {
            $no_reg = 1;
        } else {
            $no_reg = Registrasi::latest()->first()->id + 1;
        }

        return view('admin.registrasi.create', compact('jenis', 'no_reg'));
    }
    public function registrasi_edit($id)
    {
        $jenis = Kategori::get();

        $data = Registrasi::find($id);
        return view('admin.registrasi.edit', compact('jenis', 'data'));
    }
    public function registrasi_delete($id)
    {
        $data = Registrasi::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function registrasi_store(Request $req)
    {
        $param = $req->all();
        Registrasi::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/superadmin/registrasi');
    }
    public function registrasi_update(Request $req, $id)
    {

        $data = Registrasi::find($id);

        $param = $req->all();
        $data->update($param);
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/registrasi');
    }

    public function laporan()
    {
        return view('admin.laporan.index');
    }

    public function lap_petugas()
    {
        $data = Petugas::get();
        return view('admin.laporan.lap_petugas', compact('data'));
    }
    public function lap_pemeriksaan()
    {
        $data = Pemeriksaan::get();
        return view('admin.laporan.lap_pemeriksaan', compact('data'));
    }
    public function lap_rekapitulasi()
    {
        $bulan = request()->get('bulan');
        $tahun = request()->get('tahun');

        $data = Pemeriksaan::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();

        $namabulan = Carbon::createFromFormat('m', $bulan)->translatedFormat('F');

        return view('admin.laporan.lap_rekapitulasi', compact('data', 'namabulan', 'tahun'));
    }
    public function lap_registrasi()
    {
        $data = Registrasi::get();
        return view('admin.laporan.lap_registrasi', compact('data'));
    }
    // public function lap_arsip()
    // {
    //     $data = Arsip::get()->sortBy('tanggal');
    //     return view('admin.laporan.lap_arsip', compact('data'));
    // }


    public function pemeriksaan_cetak($id)
    {
        $data = Pemeriksaan::find($id);
        return view('admin.laporan.lap_rincian', compact('data'));
    }
}
