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
            ],
            [
                'designation' => 'Cafe',
                'quantite_restant' => 25,
                'prix_unitaire' => 1200
            ],
            [
                'designation' => 'Savon',
                'quantite_restant' => 55,
                'prix_unitaire' => 1000
            ],
            [
                'designation' => 'Papier',
                'quantite_restant' => 25,
                'prix_unitaire' => 200
            ]
        ];

        $this->db->table('produits')->insertBatch($data);
    }
}