<?php 

namespace App\Models;

use CodeIgniter\Model;

class AchatProduit extends Model
{
    protected $table = 'achat_produit';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_achat', 'id_produit', 'quantite', 'somme_produit'];

    public function getAllAchatProduits()
    {
        return $this->findAll();
    }

    public function insertAchatProduit($data)
    {
        return $this->insert($data);
    }
}