<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function profil()
    {
        return view('profil');
    }

    public function order()
    {
        return view('order');
    }

    public function kontak()
    {
        return view('kontak');
    }

    public function chatting()
    {
        return view('chatting');
    }
}
