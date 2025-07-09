<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaketWisata extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'description' => ['type' => 'TEXT'],
            'price'       => ['type' => 'INT'],
            'duration'    => ['type' => 'VARCHAR', 'constraint' => 50],
            'min_person'  => ['type' => 'INT'],
            'image'       => ['type' => 'VARCHAR', 'constraint' => 150],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('paket_wisata');
    }

    public function down()
    {
        $this->forge->dropTable('paket_wisata');
    }
}
