<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEducationsTable extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'teacher_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'unit' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'cid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'uid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'did' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type'           => 'DATETIME',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('teacher_id', 'teachers', 'id');
        $this->forge->createTable('educations');
    }

    public function down()
    {
        $this->forge->dropTable('educations');
    }
}
