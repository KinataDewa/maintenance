<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardStaffController extends Controller
{
    // Halaman utama dashboard staff
    public function index()
    {
        return view('dashboard.staff');
    }

    // Halaman daftar form input harian
    public function formHarian()
    {
        return view('dashboard.formharian');
    }
}
