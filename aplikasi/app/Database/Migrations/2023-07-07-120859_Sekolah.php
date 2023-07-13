<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sekolah extends Migration
{
	public function up()
	{
		//membuat tabel sekolah
		$this->forge->addField([
			'id_sekolah' => [
				'type'				=> 'int',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'id_desa' => [
				'type'				=> 'int',
				'constraint'		=> 11,
			],
			'id_jenjang' => [
				'type'				=> 'int',
				'constraint'		=> 11,
			],
			'nama_sekolah' => [
				'type'				=> 'varchar',
				'constraint'		=> 100,
			],
			'alamat' => [
				'type'				=> 'text',
			],
			'email' => [
				'type'				=> 'varchar',
				'constraint'		=> 50,
			],
			'website' => [
				'type'				=> 'varchar',
				'constraint'		=> 100,
			],
			'akreditasi' => [
				'type'				=> 'varchar',
				'constraint'		=> 25,
			],
			'koord_x' => [
				'type'				=> 'varchar',
				'constraint'		=> 100,
			],
			'koord_y' => [
				'type'				=> 'varchar',
				'constraint'		=> 100,
			],
		]);

		$this->forge->addKey('id_sekolah', true);
		$this->forge->createTable('tb_sekolah');
	}

	public function down()
	{
		//untuk menghapus tabel sekolah
		$this->forge->dropTable('tb_sekolah');
	}
}
