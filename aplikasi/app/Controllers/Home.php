<?php

namespace App\Controllers;
use App\Models\SekolahModel;
use App\Models\JenjangModel;
use App\Models\DesaModel;

class Home extends BaseController
{
	protected $SekolahModel;
	protected $JenjangModel;
	protected $DesaModel;

	public function __construct()
	{
		$this->sekolahModel = new SekolahModel();
		$this->jenjangModel = new JenjangModel();
		$this->desaModel = new DesaModel();
	}

	public function index()
	{
		$data = [
			'sekolah' => $this->sekolahModel->findAll(),
			'desa' => $this->desaModel->findAll(),
			'jenjang' => $this->jenjangModel->findAll()
		];
		return view('user-map', $data);
	}
}
