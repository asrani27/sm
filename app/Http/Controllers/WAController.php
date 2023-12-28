<?php

namespace App\Http\Controllers;

use App\Models\Nomor;
use App\Models\Whatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WAController extends Controller
{
    public function index()
    {
        $data = Whatsapp::paginate(10);
        return view('admin.wa.index', compact('data'));
    }

    public function sendMessage(Request $req)
    {
        $nomor = Nomor::get();

        foreach ($nomor as $n) {
            $response = Http::post('http://103.178.83.200:8000/send-message', [
                'message' => $req->message,
                'number' => $n->nomor,
                'file_dikirim' => $req->file
            ]);
            sleep(5);
        }
        return back();
    }
}
