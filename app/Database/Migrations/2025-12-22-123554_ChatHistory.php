<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChatHistory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'message' => [
                'type' => 'TEXT',
            ],
            'sender' => [
                'type'       => 'ENUM',
                'constraint' => ['user', 'bot'],
                'default'    => 'user',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);

        // Opsional: Jika tabel users sudah ada dan pakai engine InnoDB, bisa tambahkan foreign key
        // $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('chat_history');
    }

    public function down()
    {
        $this->forge->dropTable('chat_history');
    }
}
