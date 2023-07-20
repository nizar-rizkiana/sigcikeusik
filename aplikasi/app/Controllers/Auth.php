<?php

namespace App\Controllers;
use App\Models\AdminModel;

class Auth extends BaseController
{
    protected $AdminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $users = $this->adminModel;
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $dataUser = $users->where(['username' => $username])->first();
        if($dataUser) {
            if(password_verify($password, $dataUser['password'])) {
                session()->set([
                    'id' => $dataUser['id_admin'],
                    'username' => $dataUser['nama_admin'],
                    'level' => $dataUser['level'],
                    'logged_in' => true
                ]);
                return redirect()->to('/dashboard');
            }else{
                session()->setFlashdata('gagal', 'Username atau Password salah');
                return redirect()->to('/auth');
            }
        } else {
            session()->setFlashdata('gagal', 'Username atau Password salah');
            return redirect()->to('/auth');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth');
    }

    public function forgotpassword()
    {
        return view('forgot-password');
    }

    public function tambahAdmin()
    {
        $data = [
            'admin' => $this->adminModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('tambah-admin', $data);
    }
    public function save()
    {
        if(!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[tb_admin.username]',
                    'errors' => [
                        'required' => 'Username wajib di isi',
                        'is_unique' => 'Username sudah terdaftar'
                    ]
            ]

        ]))
        {
            return redirect()->to('/tambah-admin')->withInput();
        }

        $this->adminModel->save([
            'nama_admin' => $this->request->getVar('nama_admin'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'level' => $this->request->getVar('level'),
        ]);
        session()->setFlashdata('sukses', 'Data Admin berhasil di tambah');
        return redirect()->to('/tambah-admin');
    }

    public function edit($id)
    {
        if($this->request->getVar('password'))
        {
            $password = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
        }else{
            $password = $this->request->getVar('password_lama');
        }
        $this->adminModel->update($id, [
            'level' => $this->request->getVar('level'),
            'nama_admin' => $this->request->getVar('nama_admin'),
            'username' => $this->request->getVar('username'),
            'password' => $password,
        ]);
        session()->setFlashdata('sukses', 'Data admin berhasil di update');
        return redirect()->to('/tambah-admin');
    }
    public function delete($id)
    {
        $this->adminModel->delete($id);
        session()->setFlashdata('sukses', 'Data admin berhasil di hapus');
        return redirect()->to('/tambah-admin');
    }

}
