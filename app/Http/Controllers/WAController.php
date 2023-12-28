<?php

namespace App\Http\Controllers;

use App\Models\Nomor;
use GuzzleHttp\Client;
use App\Models\Whatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
            $path = Storage::path('video/' . $file_name);

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
