<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'phoneNumber' => [
                'type'           => 'INT',
                'constraint' => '15',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'isVerified' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'isDeleted' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'isAdmin' => [
                'type'       => 'BOOLEAN',
                'default' => false
            ],
            'createdAt' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'updatedAt' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
