<?php

namespace App\Controllers;
use App\Models\DesaModel;

class Desa extends BaseController
{
    protected $DesaModel;

    public function __construct()
    {
        $this->desaModel = new DesaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Desa',
            'desa' => $this->desaModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('tambah-desa', $data);
    }

    public function save()
    {
        if(!$this->validate([
            'desa' => [
                'rules' => 'required|is_unique[tb_desa.nama_desa]',
                    'errors' => [
                        'required' => 'Desa wajib di isi',
                        'is_unique' => 'Desa sudah terdaftar'
                    ]
            ]

        ]))
        {
            session()->setFlashdata('gagal', 'Data gagal ditambahkan');
            return redirect()->to('/desa')->withInput();
        }

        $this->desaModel->save([
            'nama_desa' => $this->request->getVar('desa'),
        ]);
        session()->setFlashdata('sukses', 'Data desa berhasil di tambah');
        return redirect()->to('/desa');
    }

    public function edit($id)
    {
        $datalama = $this->request->getVar('datalama');
        if($this->request->getVar('desa') == $datalama)
        {
            $rule = 'required';
        }else{
            $rule = 'required|is_unique[tb_desa.nama_desa]';
        }
        if(!$this->validate([
            'desa' => [
                'rules' => $rule,
                    'errors' => [
                        'required' => 'Desa wajib di isi',
                        'is_unique' => 'Desa sudah terdaftar'
                    ]
            ]

        ]))
        {
            session()->setFlashdata('gagal', 'Data gagal diupdate');
            return redirect()->to('/desa')->withInput();
        }
        $this->desaModel->update($id, [
            'nama_desa' => $this->request->getVar('desa'),
        ]);
        session()->setFlashdata('sukses', 'Data desa berhasil di update');
        return redirect()->to('/desa');
    }
    public function delete($id)
    {
        $this->desaModel->delete($id);
        session()->setFlashdata('sukses', 'Data desa berhasil di hapus');
        return redirect()->to('/desa');
    }

}
