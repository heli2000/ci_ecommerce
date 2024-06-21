<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductVariant extends Migration
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
            'variant_id' => [
                'type' => 'INT',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('variant_id', 'variant_option', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'product', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_variant');
    }

    public function down()
    {
        $this->forge->dropTable('product_variant');
    }
}
