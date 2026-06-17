<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('Caisse');
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
