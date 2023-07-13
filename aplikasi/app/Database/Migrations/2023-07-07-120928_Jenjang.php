<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jenjang extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id_jenjang' => [
				'type'				=> 'int',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'jenjang' => [
				'type' 				=> 'varchar',
				'constraint'		=> 50
			]
		]);

		$this->forge->addKey('id_jenjang', true);
		$this->forge->createTable('tb_jenjang');
	}

	public function down()
	{
		//
		$this->forge->dropTable('tb_jenjang');
	}
}
