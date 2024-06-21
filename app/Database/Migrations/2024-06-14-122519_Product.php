<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Product extends Migration
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
            'SKU' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'specification' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'qty' => [
                'type' => 'INT',
            ],
            'prize' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'category_id' => [
                'type' => 'INT'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('product');
    }

    public function down()
    {
        $this->forge->dropTable('product');
    }
}
