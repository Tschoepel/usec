<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
        $response = Http::post('http://localhost:8000/api/authReq', [
            'secret' => '',
            'user_id' => 1,
        ]);
        dd($response);
    }
}
