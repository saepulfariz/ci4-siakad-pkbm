<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAssignmentSubmissionsTable extends Migration
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
            'assignment_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'student_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'description' => [
                'type'       => 'TEXT',
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default' => 'Submitted'
                // late
            ],
            'score' => [
                'type'       => 'FLOAT',
                'null' => true,
            ],
            'feedback' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'submitted_at' => [
                'type'           => 'DATETIME',
                'null' => true,
            ],
            'review_at' => [
                'type'           => 'DATETIME',
                'null' => true,
            ],
            'review_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
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
        $this->forge->addForeignKey('assignment_id', 'assignments', 'id');
        $this->forge->addForeignKey('student_id', 'students', 'id');
        $this->forge->createTable('assignment_submissions');
    }

    public function down()
    {
        $this->forge->dropTable('assignment_submissions');
    }
}
