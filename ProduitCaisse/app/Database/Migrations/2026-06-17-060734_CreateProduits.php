<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProduits extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'auto_increment' => true
            ],
            'designation' => [
                'type' => 'VARCHAR',
                'constraint' => 25
            ],
            'quantite_restant' => [
                'type' => 'REAL'
            ],
            'prix_unitaire' => [
                'type' => 'REAL'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('produits');
    }

    public function down()
    {
        $this->forge->dropTable('produits');
    }
}