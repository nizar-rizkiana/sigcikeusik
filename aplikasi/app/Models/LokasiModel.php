<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
	protected $table = 'tb_lokasi';
	protected $primaryKey = 'id_lokasi';
	protected $useTimestamps = true;
	protected $allowedFields = ['nama_lokasi', 'lat', 'lng'];

    public function getDesa($id = false)
    {
        if($id == false){
            return $this->join('kecamatan', 'kecamatan.id_kecamatan = desa.id_kecamatan')->findAll();
        }

        return $this->where(['id_desa' => $id])->join('kecamatan', 'kecamatan.id_kecamatan = desa.id_kecamatan')->first();
    }

    public function search($keyword)
    {
        return $this->join('kecamatan', 'kecamatan.id_kecamatan = desa.id_kecamatan')->orderBy('nama_desa', 'ASC')->like('nama_desa', $keyword)->paginate('10', 'desa');
    }

    public function getPagination($pagination)
    {
        return $this->join('kecamatan', 'kecamatan.id_kecamatan = desa.id_kecamatan')->orderBy('nama_desa', 'ASC')->paginate($pagination, 'desa');
    }
}