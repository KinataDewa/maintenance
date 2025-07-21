<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PompaAirController extends Controller
{
    public function index()
    {
        return view('pompa_air.index');
    }

    public function bersih()
    {
        return view('pompa_air.bersih');
    }

    public function diesel()
    {
        return view('pompa_air.diesel');
    }

    public function hydrant()
    {
        return view('pompa_air.hydrant');
    }
}
