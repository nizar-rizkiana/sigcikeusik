<?php

namespace App\Controllers;
use App\Models\SekolahModel;
use App\Models\JenjangModel;
use App\Models\DesaModel;
use App\Models\AdminModel;

class Dashboard extends BaseController
{
    protected $SekolahModel;
    protected $JenjangModel;
    protected $DesaModel;
    protected $AdminModel;

    public function __construct()
    {
        $this->sekolahModel = new SekolahModel();
        $this->jenjangModel = new JenjangModel();
        $this->desaModel = new DesaModel();
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        $data = [
            'total_sekolah' => $this->sekolahModel->countAll(),
            'total_jenjang' => $this->jenjangModel->countAll(),
            'total_desa' => $this->desaModel->countAll(),
            'total_admin' => $this->adminModel->countAll(),
            'sekolah'    => $this->sekolahModel->findAll()
        ];
        return view('index', $data);
    }
}
