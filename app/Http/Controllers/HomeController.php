<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $motors = \App\Models\Motor::orderByDesc('created_at')->take(10)->get();
        return view('fe.home.home', compact('motors'), [

            'title' => 'Home',
        ]);
    }
}
