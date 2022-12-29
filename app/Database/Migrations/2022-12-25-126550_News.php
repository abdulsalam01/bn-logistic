<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class News extends Migration
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
                'constraint' => ['default', 'hot', 'highlight', 'other'],
                'default'    => 'default',
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 8,
                'unsigned' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => true,
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
        $this->forge->addForeignKey('category_id', 'category', 'id');
        // indexing
        $this->forge->addKey('created_at');
        $this->forge->createTable('news');        
    }

    public function down()
    {
        //
        $this->forge->dropForeignKey('news', 'news_category_foreign');
        $this->forge->dropTable('news');
    }
}
