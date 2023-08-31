<?php

namespace App\Controllers;

use App\Models\m_costumer;
use App\Models\m_item;
use App\Models\m_keranjang;
use App\Models\m_nota;

class Costumer extends BaseController
{
    protected $request;
    protected $session;
    protected $m_costumer;
    protected $m_item;
    protected $m_keranjang;
    protected $m_nota;

    public function __construct()
    {
        date_default_timezone_set("Asia/Bangkok");
        $this->session = \Config\Services::session();
        $this->session->start();

        $this->m_costumer = new m_costumer();
        $this->m_item = new m_item();
        $this->m_keranjang = new m_keranjang();
        $this->m_nota = new m_nota();
    }

    public function index()
    {
        if (session('uid') == null) {
            return redirect()->to('/auth');
        } else {
            $data = [
                'subJudul' => 'Profil',
                'tab_list' => [
                    'Beranda' => '',
                    'Keranjang' => 'costumer/keranjang',
                    'Pembelian' => 'costumer/nota',
                    'Kontak' => 'home/kontak',
                    'Tentang' => 'home/tentang'
                ],
                'user' => $this->m_costumer->getUser(session('uid'))
            ];

            return view('costumer/profil', $data);
        }
    }

    public function ubahProfil()
    {
        if (session('uid') == null) {
            return redirect()->to('/auth');
        } else {
            $data = [
                'subJudul' => 'Ubah Profil',
                'tab_list' => [
                    'Beranda' => '',
                    'Keranjang' => 'costumer/keranjang',
                    'Pembelian' => 'costumer/nota',
                    'Kontak' => 'home/kontak',
                    'Tentang' => 'home/tentang'
                ],
                'user' => $this->m_costumer->getUser(session('uid')),
                'validation' => \Config\Services::Validation()
            ];

            return view('costumer/ubah', $data);
        }
    }

    public function valProfil()
    {
        // cek email
        $email = $this->request->getVar('email');
        $ruleEmail = 'required|valid_email';
        if ($email != session('email')) {
            $ruleEmail = 'required|valid_email|is_unique';
        }

        // validasi input
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => ['required' => 'Username harus diisi.']
            ],
            'email' => [
                'rules' => $ruleEmail,
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique' => 'E-mail telah terdaftar pada akun lain. Harap gunakan e-mail lain'
                ]
            ],
            'pw' => [
                'rules' => 'required',
                'errors' => ['required' => 'Password harus diisi.']
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
            return redirect()->to('/costumer/ubahProfil')->withInput();
        } //max_size[foto,5120]| 'max_size' => 'Ukuran gambar maksimal 5MB',

        $fileFoto = $this->request->getFile('foto');
        $fotoLama = $this->request->getVar('fotoLama');
        $username = htmlspecialchars($this->request->getVar('username'), ENT_QUOTES);
        $dob = $this->request->getVar('dob');
        $gender = $this->request->getVar('gender');
        $alamat = htmlspecialchars($this->request->getVar('alamat'), ENT_QUOTES);
        $provinsi = htmlspecialchars($this->request->getVar('provinsi'), ENT_QUOTES);
        $kota = htmlspecialchars($this->request->getVar('kota'), ENT_QUOTES);
        $noHP = str_replace(' ', '', htmlspecialchars($this->request->getVar('noHP'), ENT_QUOTES));
        $paypal = str_replace(' ', '', htmlspecialchars($this->request->getVar('paypal'), ENT_QUOTES));
        $pw = htmlspecialchars($this->request->getVar('pw'), ENT_QUOTES); // password dari masukan untuk cek

        // dd($fileFoto);
        // periksa password
        if (password_verify($pw, session('pw'))) {
            // cek foto lama
            if ($fileFoto == null) {
                $namaFoto = $fotoLama;
            } else {
                // generate nama random
                $namaFoto = $fileFoto->getRandomName();
                // upload foto
                $fileFoto->move('img/user/', $namaFoto);

                //jika foto lama bukan foto default
                if ($fotoLama != 'default.jpg') {
                    // hapus foto lama
                    unlink('img/user/' . $fotoLama);
                }
            }

            $hasil = $this->m_costumer->update(session('uid'), [
                'username' => $username,
                'email' => $email,
                'dob' => $dob,
                'gender' => $gender,
                'alamat' => $alamat,
                'provinsi' => $provinsi,
                'kota' => $kota,
                'noHP' => $noHP,
                'paypalID' => $paypal,
                'foto' => $namaFoto
            ]);

            // jika pengubahan pada DB berhasil
            if ($hasil) {
                // ubah session
                $this->session->set([
                    'username' => $username,
                    'email' => $email,
                    'dob' => $dob,
                    'gender' => $gender,
                    'alamat' => $alamat,
                    'provinsi' => $provinsi,
                    'kota' => $kota,
                    'noHP' => $noHP,
                    'paypalID' => $paypal,
                    'foto' => $namaFoto
                ]);
            }

            session()->setFlashdata('ubah', '<p><b>Data profil berhasil diubah.</b> Enjoy your day <b>:)</b></p>');
            return redirect()->to('/costumer');
        } else {
            session()->setFlashdata('ubah', '<p><b>Password salah.</b> Untuk mengubah profil diperlukan password yang benar.</p>');
            return redirect()->to('/costumer/ubahProfil')->withInput();
        }
    }

    public function tambahKeranjang($id_item)
    {
        $item = $this->m_item->getItem($id_item);
        $cekKrjng = $this->m_keranjang->getItem($id_item);

        // jika item sudah berada pada keranjang dan masih aktif
        if (isset($cekKrjng)) {
            $jumlah = 1 + $cekKrjng['jumlah'];
            $subHarga = $jumlah * $item['harga'];

            $this->m_keranjang->update($cekKrjng['id'], [
                'jumlah' => $jumlah,
                'sub_harga' => $subHarga
            ]);
        } else {
            $this->m_keranjang->save([
                'uid' => session('uid'),
                'id_item' => $item['id'],
                'jumlah' => 1,
                'sub_harga' => $item['harga'],
                'status' => 1
            ]);
        }

        session()->setFlashdata('success', '<p><b>Produk berhasil ditambah ke keranjang.</b></p>');
        return redirect()->to('/home');
    }

    public function hapusKeranjang($id)
    {
        $hasil = $this->m_keranjang->delete($id);

        if ($hasil) {
            session()->setFlashdata('success', '<p><b>Produk berhasil dihapus dari keranjang.</b></p>');
        } else {
            session()->setFlashdata('fail', '<p><b>Produk gagal dihapus dari keranjang.</b></p>');
        }

        return redirect()->to('/costumer/keranjang');
    }

    public function keranjang()
    {
        if (session('uid') == null) {
            return redirect()->to('/auth');
        } else {
            $keranjang = $this->m_keranjang->getList(session('uid'));
            $listItem = [];

            foreach ($keranjang as $k) {
                $listItem[] = [
                    $k['id'] => $this->m_item->getNamaItem($k['id_item'])[0],
                    'harga' => $this->m_item->getHarga($k['id_item'])['harga']
                ];
            }

            $data = [
                'subJudul' => 'Keranjang',
                'tab_list' => [
                    'Beranda' => '',
                    'Keranjang' => 'costumer/keranjang',
                    'Pembelian' => 'costumer/nota',
                    'Kontak' => 'home/kontak',
                    'Tentang' => 'home/tentang'
                ],
                'keranjang' => $keranjang,
                'items' => $listItem
            ];
            // dd($listItem);
            return view('costumer/keranjang', $data);
        }
    }

    // fungsi untuk menambah daftar keranjang ke dalam nota
    public function checkout()
    {
        $uid = session('uid');
        $daftarKrjg = $this->m_keranjang->getList($uid);
        $list_keranjang = "";
        $total_harga = 0;

        foreach ($daftarKrjg as $list) {
            if ($this->request->getVar($list['id']) != null) {
                $list_keranjang = $list_keranjang . $list['id'] . ';';
                $total_harga += $list['sub_harga'];
            }
        }
        // echo $total_harga;
        // echo date("Y-m-d H:i:s");
        $hasil = $this->m_nota->save([
            'list_krjg' => $list_keranjang,
            'uid' => session('uid'),
            'total_harga' => $total_harga,
            'tgl' => date("Y-m-d H:i:s"),
            'status' => 1
        ]);

        if ($hasil) {
            // mengubah status data keranjang yang telah ditambahkan pada nota menjadi 2
            foreach ($daftarKrjg as $row) {
                if ($this->request->getVar($row['id']) != null) {
                    $this->m_keranjang->update($row['id'], ['status' => 2]);
                }
            }

            session()->setFlashdata('success', '<p><b>Berhasil melakukan checkout.</b> Pesanan Anda sedang dalam tahap proses, silahkan menuju halaman Riwayat Pembelian untuk melihat status pesanan Anda.</p>');
        } else {
            session()->setFlashdata('fail', '<p><b>Gagal melakukan checkout.</b></p>');
        }

        return redirect()->to('costumer/keranjang');
    }

    public function nota()
    {
        if (session('uid') == null) {
            return redirect()->to('/auth');
        } else {
            $daftarNota = $this->m_nota->getNota(session('uid'));
            $listItem = [];
            foreach ($daftarNota as $n) {
                $daftarItem = explode(';', $n['list_krjg']);
                for ($i = 0; $i < (sizeof($daftarItem) - 1); $i++) {
                    $keranjang = $this->m_keranjang->getList(session('uid'), 2, $daftarItem[$i]);
                    $listItem[] = [
                        'id_nota' => $n['id'],
                        'id_krjg' => $keranjang['id'],
                        'nama_item' => $this->m_item->getNamaItem($keranjang['id_item'])[0],
                        'jumlah' => $keranjang['jumlah'],
                        'harga_satuan' => $this->m_item->getHarga($keranjang['id_item'])['harga'],
                        'sub_harga' => $keranjang['sub_harga']
                    ];
                }
            }
            // dd($listItem);

            $data = [
                'subJudul' => 'Pembelian',
                'tab_list' => [
                    'Beranda' => '',
                    'Keranjang' => 'costumer/keranjang',
                    'Pembelian' => 'costumer/nota',
                    'Kontak' => 'home/kontak',
                    'Tentang' => 'home/tentang'
                ],
                'nota' => $daftarNota,
                'items' => $listItem
            ];
            // dd($data);
            return view('costumer/nota', $data);
        }
    }

    public function hapusNota($id)
    {
        $nota = $this->m_nota->getNota(session('uid'), $id)[0];

        // jika pembelian sudah dalam status terkirim
        if ($nota['status'] > 1) {
            session()->setFlashdata('fail', '<p>Pesanan <b>gagal dibatalkan</b>. Pastikan pesanan belum terkirim, pesanan terkirim tidak dapat dibatalkan.</p>');
        } else {
            // jika pesanan masih dalam proses
            $hasil = $this->m_nota->update($id, ['status' => (-1)]);

            if ($hasil) {
                session()->setFlashdata('success', '<p>Pesanan <b>berhasil dibatalkan</b>.</p>');
            } else {
                session()->setFlashdata('fail', '<p>Pesanan <b>gagal dibatalkan</b>.</p>');
            }
        }

        return redirect()->to('/costumer/nota');
    }

    public function cetakNota($id)
    {
        $nota = $this->m_nota->getNota(session('uid'), $id)[0];
        $user = $this->m_costumer->getUser(session('uid'));
        $listKrjg = explode(';', $nota['list_krjg']);
        $rincian = [];

        for ($i = 0; $i < (sizeof($listKrjg) - 1); $i++) {
            $keranjang = $this->m_keranjang->getList(session('uid'), 2, $listKrjg[$i]);
            $item = $this->m_item->getItem($keranjang['id_item']);
            $rincian[] = [
                'nama_item' => $item['nama_item'],
                'harga_satuan' => $item['harga'],
                'jumlah' => $keranjang['jumlah'],
                'sub_harga' => $keranjang['sub_harga']
            ];
        }

        $data = [
            'tgl' => $nota['tgl'],
            'user' => $user,
            'rincian' => $rincian
        ];
        return view('costumer/cetakNota', $data);
    }
}
