<?php

namespace App\Http\Controllers;

use App\Jobs\DispathcWA;
use App\Models\Nomor;
use App\Models\Riwayat;
use GuzzleHttp\Client;
use App\Models\Whatsapp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class WAController extends Controller
{
    public function index()
    {
        $data = Whatsapp::paginate(10);
        $kontak = Nomor::count();
        return view('admin.wa.index', compact('data', 'kontak'));
    }
    public function delete($id)
    {
        Whatsapp::find($id)->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }
    public function create()
    {
        return view('admin.wa.create');
    }

    public function store(Request $req)
    {
        $file      = $req->file('file');
        $file_path = $file->getPathname();
        $file_mime = $file->getMimeType('video');
        $file_name = Str::random(10) . str_replace(' ', '', $file->getClientOriginalName());

        $file->storeAs('public/video', $file_name);
        $s = new Whatsapp;
        $s->isi = $req->isi;
        $s->file = $file_name;
        $s->kirim_ke = $req->kirim_ke;
        $s->save();

        Session::flash('success', 'Berhasil disimpan');
        return redirect('/superadmin/wa');
    }

    public function kirim($id)
    {
        $data       = Whatsapp::find($id);
        $nomor      = Nomor::where('jenis', $data->kirim_ke)->get();
        foreach ($nomor as $n) {
            //dd($n);
            DispathcWA::dispatch($n, $data);
        }
        Session::flash('success', 'Berhasil dikirim');
        return back();
    }

    public function sendMessage(Request $req)
    {
        $nomor = Nomor::get();
        $file      = $req->file('file');
        $api_url   = 'http://103.178.83.200:8000/send-message';
        if ($file == null) {
            foreach ($nomor as $n) {
                $client = new Client();
                $response = $client->request("POST", $api_url, [
                    'multipart' => [
                        [
                            'name' => 'text',
                            'contents' => $req->message
                        ],
                        [
                            'name' => 'number',
                            'contents' => $n->nomor,
                        ],
                    ]
                ]);
                $code = $response->getStatusCode();
                sleep(5);
            }
            return back();
        } else {
            //dd($file);
            $file_path = $file->getPathname();
            $file_mime = $file->getMimeType('video');
            $file_name = $file->getClientOriginalName();
            $file->storeAs('public/video', $file_name);
            $path = 'https://sahabatmukhyar.com/storage/video/' . $file_name;

            $client = new Client();

            foreach ($nomor as $n) {
                $response = $client->request("POST", $api_url, [
                    'form_params' => [
                        'number' => $n->nomor,
                        'video' => [
                            "url" => $path,
                        ],
                        "caption" => $req->message,
                    ]
                ]);

                $code = $response->getStatusCode();

                sleep(5);
            }
            return back();
        }
    }
}
