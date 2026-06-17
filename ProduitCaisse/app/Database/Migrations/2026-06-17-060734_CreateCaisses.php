<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCaisses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INTEGER',
                'auto_increment' => true
            ],
            'numero_caisse' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('caisse');
    }

    public function down()
    {
        $this->forge->dropTable('caisse');
    }
}