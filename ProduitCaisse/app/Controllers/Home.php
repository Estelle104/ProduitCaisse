<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return redirect()->to('/caisse');
    }

    public function login(): string
    {
        return view('Login');
    }

    public function achat(): string
    {
        return view('Achat');
    }
}
