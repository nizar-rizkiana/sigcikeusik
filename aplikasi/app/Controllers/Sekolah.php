<?php

namespace App\Controllers;
use App\Models\SekolahModel;
use App\Models\DesaModel;
use App\Models\JenjangModel;

class Sekolah extends BaseController
{
    protected $SekolahModel;
    protected $DesaModel;
    protected $JenjangModel;

    public function __construct()
    {
        $this->sekolahModel = new SekolahModel();
        $this->desaModel = new DesaModel();
        $this->jenjangModel = new JenjangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data sekolah',
            'sekolah' => $this->sekolahModel->getSekolah(),
            'validation' => \Config\Services::validation()
        ];
        return view('sekolah', $data);
    }
    
    public function input()
    {
        $data = [
            'title' => 'Data sekolah',
            'jenjang' => $this->jenjangModel->findAll(),
            'desa' => $this->desaModel->findAll(),
            'sekolah' => $this->sekolahModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('input-sekolah', $data);
    }
    
    public function edit($id)
    {
        $data = [
            'title' => 'Data sekolah',
            'sekolah' => $this->sekolahModel->find($id),
            'dataSekolah' => $this->sekolahModel->findAll(),
            'jenjang' => $this->jenjangModel->findAll(),
            'desa' => $this->desaModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('edit-sekolah', $data);
    }

    public function save()
    {
        if(!$this->validate([
            'nama_sekolah' => [
                'rules' => 'required|is_unique[tb_sekolah.nama_sekolah]',
                    'errors' => [
                        'required' => 'Nama Sekolah wajib di isi',
                        'is_unique' => 'Nama Sekolah sudah terdaftar'
                    ]
            ],
        ]))
        {
            session()->setFlashdata('gagal', 'Data gagal ditambahkan');
            return redirect()->to('/tambah-sekolah')->withInput();
        }

        $this->sekolahModel->save([
            'nama_sekolah' => $this->request->getVar('nama_sekolah'),
            'id_jenjang' => $this->request->getVar('jenjang'),
            'id_desa' => $this->request->getVar('desa'),
            'akreditasi' => $this->request->getVar('akreditasi'),
            'email' => $this->request->getVar('email'),
            'website' => $this->request->getVar('website'),
            'alamat' => $this->request->getVar('alamat'),
            'koord_x' => $this->request->getVar('koord_x'),
            'koord_y' => $this->request->getVar('koord_y'),
            'average1' => $this->request->getVar('average1'),
            'average2' => $this->request->getVar('average2'),
        ]);
        session()->setFlashdata('sukses', 'Data Sekolah berhasil di tambah');
        return redirect()->to('/sekolah');
    }

    public function update($id)
    {
        $datalama = $this->request->getVar('datalama');
        if($this->request->getVar('nama_sekolah') == $datalama)
        {
            $rule = 'required';
        }else{
            $rule = 'required|is_unique[tb_sekolah.nama_sekolah]';
        }
        if(!$this->validate([
            'nama_sekolah' => [
                'rules' => $rule,
                    'errors' => [
                        'required' => 'Nama Sekolah wajib di isi',
                        'is_unique' => 'Nama Sekolah sudah terdaftar'
                    ]
            ]
        ]))
        {
            session()->setFlashdata('gagal', 'Data gagal diupdate');
            return redirect()->to('/sekolah/edit/'.$id)->withInput();
        }
        $this->sekolahModel->update($id, [
            'nama_sekolah' => $this->request->getVar('nama_sekolah'),
            'id_jenjang' => $this->request->getVar('jenjang'),
            'id_desa' => $this->request->getVar('desa'),
            'akreditasi' => $this->request->getVar('akreditasi'),
            'email' => $this->request->getVar('email'),
            'website' => $this->request->getVar('website'),
            'alamat' => $this->request->getVar('alamat'),
            'koord_x' => $this->request->getVar('koord_x'),
            'koord_y' => $this->request->getVar('koord_y'),
            'average1' => $this->request->getVar('average1'),
            'average2' => $this->request->getVar('average2'),
        ]);
        session()->setFlashdata('sukses', 'Data Sekolah berhasil di update');
        return redirect()->to('/sekolah');
    }
    public function delete($id)
    {
        $this->sekolahModel->delete($id);
        session()->setFlashdata('sukses', 'Data Sekolah berhasil di hapus');
        return redirect()->to('/sekolah');
    }

}
