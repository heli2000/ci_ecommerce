<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductKeyword extends Migration
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
            'product_id' => [
                'type' => 'INT',
            ],
            'keyword_id' => [
                'type' => 'INT',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('keyword_id', 'keywords', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'product', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_keyword');
    }

    public function down()
    {
        $this->forge->dropTable('product_keyword');
    }
}
