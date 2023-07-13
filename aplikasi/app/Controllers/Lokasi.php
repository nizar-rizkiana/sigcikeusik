<?php

namespace App\Controllers;
use App\Models\LokasiModel;

class Lokasi extends BaseController
{
    protected $LokasiModel;

    public function __construct()
    {
        $this->lokasiModel = new LokasiModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if($keyword)
        {
            $lokasi = $this->lokasiModel->search($keyword);
        }else{
            $lokasi = $this->lokasiModel->findAll();
        }
        $data = [
            'lokasi' => $lokasi,
        ];
        return view('lokasi', $data);
    }

    public function input()
    {
        $data = [
            // 'kecamatan' => $this->kecamatanModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('form/input-lokasi', $data);
    }

    public function save()
    {
        if(!$this->validate([
            'lokasi' => [
                'rules' => 'required|is_unique[tb_lokasi.nama_lokasi]',
                    'errors' => [
                        'required' => 'Nama lokasi wajib di isi',
                        'is_unique' => 'Nama lokasi sudah terdaftar'
                    ]
            ],
            'lat' => [
                'rules' => 'is_unique[tb_lokasi.lat]',
                    'errors' =>[
                        'is_unique' => 'Latitude sudah terdaftar'
                    ]
            ]

        ]))
        {
            return redirect()->to('/input-lokasi')->withInput();
        }

		$this->lokasiModel->save([
			'nama_lokasi' => $this->request->getVar('lokasi'),
            'lat' => $this->request->getVar('lat'),
            'lng' => $this->request->getVar('lng')
		]);
		session()->setFlashdata('sukses', 'Data Lokasi berhasil di tambah');
		return redirect()->to('/lokasi');
    }

    public function edit($id)
    {
        // $lokasi = $this->lokasiModel->getDesa($id);
        // dd($this->desaModel->getDesa($id));
        $data = [
            'lokasi' => $this->lokasiModel->find($id),
            'validation' => \Config\Services::validation()
        ];

        return view('form/edit-lokasi', $data);
    }

    public function update($id)
    {
        $dataLama = $this->lokasiModel->find($id);
        if($dataLama['nama_lokasi'] == $this->request->getVar('lokasi'))
        {
            $ruleLokasi = 'required';
        } else {
            $ruleLokasi = 'required|is_unique[tb_lokasi.nama_lokasi]';
        }

        if(!$this->validate([
            'lokasi' => [
                'rules' => $ruleLokasi,
                    'errors' => [
                        'required' => 'Nama lokasi wajib di isi',
                        'is_unique' => 'Nama lokasi sudah terdaftar'
                    ]
            ]

        ]))
        {
            return redirect()->to('/edit-lokasi/'.$id)->withInput();
        }

		$data = [
			'nama_lokasi' => $this->request->getVar('lokasi'),
            'lat' => $this->request->getVar('lat'),
            'lng' => $this->request->getVar('lng')
		];
        

        $this->lokasiModel->update($id, $data);
		session()->setFlashdata('sukses', 'Data Lokasi berhasil di update');
		return redirect()->to('/lokasi');
    }

    public function delete($id)
    {
        $this->lokasiModel->delete($id);

        session()->setFlashdata('sukses', 'Data lokasi berhasil di hapus');
        return redirect()->to('/lokasi');
    }
}
