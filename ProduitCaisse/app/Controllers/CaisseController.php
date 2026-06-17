<?php

namespace App\Controllers;

use App\Models\Caisse;

class CaisseController extends BaseController
{
    public function index()
    {
        $caisseModel = new Caisse();
        $data['caisses'] = $caisseModel->findAll();
        return view('Caisse', $data);
    }


    public function choixCaisse()
    {
        $id_caisse = $this->request->getPost('id_caisse');
        session()->set('id_caisse', $id_caisse);
        return redirect()->to('client/achat');
    }
}
