<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Blog extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'bid'          => [
                        'type'           => 'INT',
                        'constraint'     => 5,
                        'unsigned'       => true,
                        'auto_increment' => true,
                ],
                'b_title'       => [
                        'type'       => 'VARCHAR',
                        'constraint' => '100',
                ],
                'b_image' => [
                        'type' => 'TEXT',
                        'constraint' => '100',
                ],
                'b_description' => [
                        'type' => 'TEXT',
                        'constraint' => '100',
                ],
        ]);
        $this->forge->addKey('bid', true);
        $this->forge->createTable('blog');
    }

    public function down()
    {
        $this->forge->dropTable('blog');
    }
}
