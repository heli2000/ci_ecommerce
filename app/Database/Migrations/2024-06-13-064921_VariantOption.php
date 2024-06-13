<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VariantOption extends Migration
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
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'variant_id' => [
                'type'           => 'INT',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('variant_id', 'variant', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('variant_option');
    }

    public function down()
    {
        $this->forge->dropTable('variant_option');
    }
}
