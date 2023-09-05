<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{
	protected $table = 'tb_sekolah';
	protected $primaryKey = 'id_sekolah';
	protected $useTimestamps = false;
	protected $allowedFields = ['id_jenjang', 'id_desa', 'nama_sekolah', 'alamat', 'email', 'website', 'akreditasi', 'koord_x', 'koord_y', 'average1', 'average2', 'gambar'];

	public function getSekolah()
	{
		return $this->join('tb_desa', 'tb_desa.id_desa = tb_sekolah.id_desa')->join('tb_jenjang', 'tb_jenjang.id_jenjang = tb_sekolah.id_jenjang')->findAll();
	}
}
