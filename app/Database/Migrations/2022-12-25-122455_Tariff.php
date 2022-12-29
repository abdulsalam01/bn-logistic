<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Tariff extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'raw_source' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'packet_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'estimation_time' => [
                'type'    => 'TIMESTAMP',
                'null' => false,
            ],
            'weight_range' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'price_range' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
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
        $this->forge->createTable('tariff');        
    }

    public function down()
    {
        //
        $this->forge->dropTable('tariff');
    }
}
