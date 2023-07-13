<?php

namespace App\Controllers;
use App\Models\JenjangModel;

class Jenjang extends BaseController
{
    protected $JenjangModel;

    public function __construct()
    {
        $this->jenjangModel = new JenjangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data jenjang',
            'jenjang' => $this->jenjangModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('tambah-jenjang', $data);
    }

    public function save()
    {
        if(!$this->validate([
            'jenjang' => [
                'rules' => 'required|is_unique[tb_jenjang.jenjang]',
                    'errors' => [
                        'required' => 'jenjang wajib di isi',
                        'is_unique' => 'jenjang sudah terdaftar'
                    ]
            ]

        ]))
        {
            session()->setFlashdata('gagal', 'Data gagal ditambahkan');
            return redirect()->to('/jenjang')->withInput();
        }

        $this->jenjangModel->save([
            'jenjang' => $this->request->getVar('jenjang'),
        ]);
        session()->setFlashdata('sukses', 'Data jenjang berhasil di tambah');
        return redirect()->to('/jenjang');
    }

    public function edit($id)
    {
        $datalama = $this->request->getVar('datalama');
        if($this->request->getVar('jenjang') == $datalama)
        {
            $rule = 'required';
        }else{
            $rule = 'required|is_unique[tb_jenjang.jenjang]';
        }
        if(!$this->validate([
            'jenjang' => [
                'rules' => $rule,
                    'errors' => [
                        'required' => 'jenjang wajib di isi',
                        'is_unique' => 'jenjang sudah terdaftar'
                    ]
            ]

        ]))
        {
            session()->setFlashdata('gagal', 'Data gagal diupdate');
            return redirect()->to('/jenjang')->withInput();
        }
        $this->jenjangModel->update($id, [
            'jenjang' => $this->request->getVar('jenjang'),
        ]);
        session()->setFlashdata('sukses', 'Data jenjang berhasil di update');
        return redirect()->to('/jenjang');
    }
    public function delete($id)
    {
        $this->jenjangModel->delete($id);
        session()->setFlashdata('sukses', 'Data jenjang berhasil di hapus');
        return redirect()->to('/jenjang');
    }

}
