<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        //membuat tabel admin
        $this->forge->addField([
            'id_admin' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'nama_admin' => [
                'type'              => 'varchar',
                'constraint'        => 25,
            ],
            'username' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'password' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'level' => [
                'type'              => 'INT',
                'constraint'        => 2, //1= admin; 2= kepala dinas;
            ]
        ]);

        $this->forge->addKey('id_admin', true);
        $this->forge->createTable('tb_admin');
    }

    public function down()
    {
        //untuk menghapus tabel admin
        $this->forge->dropTable('tb_admin');
    }
}
