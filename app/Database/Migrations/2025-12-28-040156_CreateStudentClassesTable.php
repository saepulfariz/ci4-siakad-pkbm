<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentClassesTable extends Migration
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
            'student_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'class_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
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
        $this->forge->addForeignKey('student_id', 'students', 'id');
        $this->forge->addForeignKey('class_id', 'classes', 'id');
        $this->forge->createTable('student_classes');
    }

    public function down()
    {
        $this->forge->dropTable('student_classes');
    }
}
