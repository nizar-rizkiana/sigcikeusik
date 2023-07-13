<?php

namespace App\Models;

use CodeIgniter\Model;

class DesaModel extends Model
{
	protected $table = 'tb_desa';
	protected $primaryKey = 'id_desa';
	protected $useTimestamps = false;
	protected $allowedFields = ['nama_desa'];

}