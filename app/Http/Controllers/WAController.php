<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WAController extends Controller
{
    public function index()
    {
        return view('admin.wa.index');
    }
}
