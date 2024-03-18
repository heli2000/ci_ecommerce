<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Otp extends Migration
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
            'userId' => [
                'type'       => 'INT',
                'constraint'     => 5,
            ],
            'otp' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'expireTime' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('otp');
    }

    public function down()
    {
        $this->forge->dropTable('otp');
    }
}
