<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAchatProduits extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'auto_increment' => true
            ],
            'id_achat' => [
                'type' => 'INTEGER'
            ],
            'id_produit' => [
                'type' => 'INTEGER'
            ],
            'quantite' => [
                'type' => 'REAL'
            ],
            'somme_produit' => [
                'type' => 'REAL'
            ]
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey(
            'id_achat',
            'achat',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'id_produit',
            'produits',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('achat_produit');
    }

    public function down()
    {
        $this->forge->dropTable('achat_produit');
    }
}