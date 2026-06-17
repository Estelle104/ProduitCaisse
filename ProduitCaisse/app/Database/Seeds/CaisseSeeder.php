<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CaisseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['numero_caisse' => 'C001'],
            ['numero_caisse' => 'C002']
        ];

        $this->db->table('caisse')->insertBatch($data);
    }
}