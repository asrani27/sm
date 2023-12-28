<?php

namespace App\Http\Controllers;

use App\Models\Nomor;
use GuzzleHttp\Client;
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
        $file      = $req->file('file');
        $api_url   = 'http://103.178.83.200:8000/send-message';
        if ($file == null) {
            foreach ($nomor as $n) {
                $client = new Client();
                $response = $client->request("POST", $api_url, [
                    'multipart' => [
                        [
                            'name' => 'message',
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
            $file_path = $file->getPathname();
            $file_mime = $file->getMimeType('image');
            $file_name = $file->getClientOriginalName();

            foreach ($nomor as $n) {
                $client = new Client();
                $response = $client->request("POST", $api_url, [
                    'multipart' => [
                        [
                            'name' => 'message',
                            'contents' => $req->message
                        ],
                        [
                            'name' => 'number',
                            'contents' => $n->nomor,
                        ],
                        [
                            'name' => 'file_dikirim',
                            'filename' => $file_name,
                            'Mime-Type' => $file_mime,
                            'contents' => fopen($file_path, 'r')
                        ],
                    ]
                ]);
                $code = $response->getStatusCode();
                sleep(5);
            }
            return back();
        }
    }
}
