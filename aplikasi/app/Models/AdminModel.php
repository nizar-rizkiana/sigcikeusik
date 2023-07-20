<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
	protected $table = 'tb_admin';
	protected $primaryKey = 'id_admin';
	protected $useTimestamps = false;
	protected $allowedFields = ['nama_admin', 'username', 'password', 'level'];

}