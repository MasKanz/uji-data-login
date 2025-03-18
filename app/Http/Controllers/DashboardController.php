<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function admin()
    {
        return view('dashboard.admin');
    }

    public function customer()
    {
        return view('dashboard.customer');
    }
}
