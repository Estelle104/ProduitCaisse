<?php

namespace App\Models;

use CodeIgniter\Model;

class Produit extends Model
{
    protected $table = 'produits';
    protected $primaryKey = 'id';
    protected $allowedFields = ['designation', 'prix_unitaire', 'quantite_restant'];

    public function getAllProduits()
    {
        return $this->findAll();
    }

    public function getProduitById($id)
    {
        return $this->where('id', $id)->first();
    }
}