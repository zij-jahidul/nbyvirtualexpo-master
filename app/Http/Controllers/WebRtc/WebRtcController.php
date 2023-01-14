<?php

namespace App\Http\Controllers\WebRtc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebRtcController extends Controller
{
    public function index()
    {
        return view('webrtc.home');
    }
}
