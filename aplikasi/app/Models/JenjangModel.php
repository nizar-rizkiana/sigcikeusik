<?php

namespace App\Models;

use CodeIgniter\Model;

class JenjangModel extends Model
{
	protected $table = 'tb_jenjang';
	protected $primaryKey = 'id_jenjang';
	protected $useTimestamps = false;
	protected $allowedFields = ['jenjang'];

}