<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Desa extends Migration
{
	public function up()
	{
		//untuk membuat tabel desa
		$this->forge->addField([
			'id_desa' => [
				'type'				=> 'int',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'nama_desa' => [
				'type'				=> 'varchar',
				'constraint'		=> 100,
			]
		]);

		$this->forge->addKey('id_desa', true);
		$this->forge->createTable('tb_desa');
	}

	public function down()
	{
		//untuk menghapus tabel desa
		$this->forge->dropTable('tb_desa');
	}
}
