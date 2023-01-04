<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Portfolio extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 6,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' => [
                'type'    => 'TEXT',
                'null' => false,
            ],
            'path' => [
                'type' => 'VARCHAR',
                'constraint' => '255',                
            ],
            'status' => [
                'type' => 'SMALLINT', // 1: active, 0: not active
                'constraint' => 1,
                'unsigned' => true,
                'default' => 0,
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['default', 'product', 'app', 'branding', 'other'],
                'default'    => 'default',
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        // indexing
        $this->forge->addKey('created_at');
        $this->forge->addKey('type');
        $this->forge->createTable('portfolio');
    }

    public function down()
    {
        //
        $this->forge->dropTable('portfolio');
    }
}
