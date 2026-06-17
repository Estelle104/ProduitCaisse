<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAchats extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'auto_increment' => true
            ],
            'id_caisse' => [
                'type' => 'INTEGER'
            ],
            'somme_total' => [
                'type' => 'REAL'
            ],
            'id_client' => [
                'type' => 'INTEGER'
            ]
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey(
            'id_caisse',
            'caisse',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'id_client',
            'clients',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('achat');
    }

    public function down()
    {
        $this->forge->dropTable('achat');
    }
}