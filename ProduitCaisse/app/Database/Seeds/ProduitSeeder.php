<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProduitSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'designation' => 'Riz',
                'quantite_restant' => 100,
                'prix_unitaire' => 2500
            ],
            [
                'designation' => 'Huile',
                'quantite_restant' => 50,
                'prix_unitaire' => 12000
            ]
        ];

        $this->db->table('produits')->insertBatch($data);
    }
}