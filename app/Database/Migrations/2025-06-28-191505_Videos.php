<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Videos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'youtube_url' => ['type' => 'VARCHAR', 'constraint' => 200],
            'created_at'  => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('videos');
    }

    public function down()
    {
        $this->forge->dropTable('videos');
    }
}
