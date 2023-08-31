<?php

namespace App\Controllers;

use App\Models\m_costumer;
use App\Models\m_admin;

class Auth extends BaseController
{
    protected $request;
    protected $session;
    protected $m_costumer;
    protected $m_admin;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();

        $this->m_costumer = new m_costumer();
        $this->m_admin = new m_admin();
    }

    public function index()
    {
        if (session('uid') != null) {
            return redirect()->to('/home');
        } else {
            $data = [
                'subJudul' => 'Login',
                'validation' => \Config\Services::Validation()
            ];
            return view('auth/login', $data);
        }
    }

    public function valLogin()
    {
        // validasi input
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Format email tidak valid.'
                ]
            ],
            'pw' => [
                'rules' => 'required',
                'errors' => ['required' => 'Password harus diisi.']
            ]
        ])) {
            return redirect()->to('/auth')->withInput();
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('pw');

        $costumer = $this->m_costumer->getUserByEmail($email);

        // jika email terdaftar
        if ($costumer != null) {
            // jika password benar lanjut ke dasboard
            if (password_verify($password, $costumer['pw'])) {
                $this->session->set($costumer);
                return redirect()->to('/home');
            } else {
                // pesan jika password salah
                session()->setFlashdata('loginFailed', '<p><b>Password Salah.</b></p>');

                // jika password salah kembali ke login
                return redirect()->to('/auth')->withInput();
            }
        } else {
            // jika tidak terdaftar pada tabel costumer
            // cari pada tabel admin
            $admin = $this->m_admin->getAdminByEmail($email);
            if ($admin != null) {
                // jika password benar lanjut ke dasboard
                if (password_verify($password, $admin['pw'])) {
                    $this->session->set($admin);
                    return redirect()->to('admin');
                } else {
                    // pesan jika password salah
                    session()->setFlashdata('loginFailed', '<p><b>Password Salah.</b></p>');

                    // jika password salah kembali ke login
                    return redirect()->to('/auth')->withInput();
                }
            } else {
                session()->setFlashdata('loginFailed', '<p><b>Email Tidak terdaftar.</b> Mohon lakukan registrasi terlebih dahulu</p>');
                // jika email tidak terdaftar
                return redirect()->to('/auth')->withInput();
            }
        }
    }

    public function logout()
    {
        // menghapus session saat logut
        session()->destroy();
        return redirect()->to('');
    }

    public function registrasi()
    {
        if (session('uid') != null) {
            return redirect()->to('/home');
        } else {
            $data = [
                'subJudul' => 'Registrasi',
                'tab_list' => [
                    'Beranda' => '',
                    'Kontak' => 'home/kontak',
                    'Tentang' => 'home/tentang'
                ],
                'validation' => \Config\Services::Validation()
            ];
            return view('auth/regis', $data);
        }
    }

    public function valRegis()
    {
        // validasi input
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => ['required' => 'Username harus diisi.']
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[costumer.email]',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique' => 'E-mail telah terdaftar pada akun lain. Harap gunakan e-mail lain'
                ]
            ],
            'pw' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'min_length' => 'Panjang password minimal 8 karakter'
                ]
            ],
            'pw2' => [
                'rules' => 'required|matches[pw]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'matches' => 'Konfirmasi password berbeda dengan password'
                ]
            ],
            'dob' => [
                'rules' => 'required',
                'errors' => ['required' => 'Tanggal lahir harus diisi.']
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => ['required' => 'Alamat harus diisi.']
            ],
            'provinsi' => [
                'rules' => 'required',
                'errors' => ['required' => 'Provinsi harus diisi.']
            ],
            'kota' => [
                'rules' => 'required',
                'errors' => ['required' => 'Kota harus diisi.']
            ],
            'noHP' => [
                'rules' => 'required|max_length[12]',
                'errors' => [
                    'required' => 'Nomor HP harus diisi.',
                    'max_length' => 'Nomor HP tidak boleh lebih dari 12 digit. Masukkan nomor tanpa spasi dan dengan format 081234567890'
                ]
            ],
            'paypal' => [
                'rules' => 'required',
                'errors' => ['required' => 'ID Pay-pal harus diisi.']
            ]
        ])) {
            return redirect()->to('/auth/registrasi')->withInput();
        }

        $username = htmlspecialchars($this->request->getVar('username'), ENT_QUOTES);
        $pw = htmlspecialchars($this->request->getVar('pw'), ENT_QUOTES);
        // $pw2 = htmlspecialchars($this->request->getVar('pw2'), ENT_QUOTES);
        $dob = $this->request->getVar('dob');
        $gender = $this->request->getVar('gender');
        $alamat = htmlspecialchars($this->request->getVar('alamat'), ENT_QUOTES);
        $provinsi = htmlspecialchars($this->request->getVar('provinsi'), ENT_QUOTES);
        $kota = htmlspecialchars($this->request->getVar('kota'), ENT_QUOTES);
        $noHP = str_replace(' ', '', htmlspecialchars($this->request->getVar('noHP'), ENT_QUOTES));
        $paypal = str_replace(' ', '', htmlspecialchars($this->request->getVar('paypal'), ENT_QUOTES));

        $hashedPW = password_hash($pw, PASSWORD_DEFAULT);

        $this->m_costumer->save([
            'username' => $username,
            'email' => $this->request->getVar('email'),
            'pw' => $hashedPW,
            'dob' => $dob,
            'gender' => $gender,
            'alamat' => $alamat,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'noHP' => $noHP,
            'paypalID' => $paypal,
            'foto' => 'default.jpg'
        ]);

        session()->setFlashdata('regisSuc', '<p><b>Registrasi berhasil.</b> Silahkan login untuk melakukan transaksi</p>');
        return redirect()->to('/auth');
    }

    public function coba()
    {
        // 
    }
}
