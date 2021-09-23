<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'uid'          => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'fname'       => [
                    'type'       => 'TEXT',
                    'constraint' => '50',
            ],
            'lname'       => [
                    'type'       => 'TEXT',
                    'constraint' => '50',
            ],
            'email'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
            ],
            'phone' => [
                    'type' => 'INT',
                    'constraint' => '10',
            ],
            'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => '10',
            ]
        ]);
        $this->forge->addKey('uid', true);
        $this->forge->createTable('signup_user');
    }

    public function down()
    {
        $this->forge->dropTable('signup_user');
    }
}