<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pesan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'auto_increment' => true],
            'name'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'subject'   => ['type' => 'VARCHAR', 'constraint' => 150],
            'message'   => ['type' => 'TEXT'],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pesan');
    }

    public function down()
    {
        $this->forge->dropTable('pesan');
    }
}
