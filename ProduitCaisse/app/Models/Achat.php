<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Router\RouteCollection;


class Achat extends Model
{
    protected $table = 'achat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_caisse', 'somme_total', 'id_client'];

    public function getAllAchats()
    {
        return $this->findAll();
    }
}