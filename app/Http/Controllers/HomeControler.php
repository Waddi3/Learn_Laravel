<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeControler extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function contact()
    {
        return view('home.contact');
    }
    
    public function secret(){
        return view('secret');
    }
    
}
