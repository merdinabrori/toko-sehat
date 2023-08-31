<?php

namespace App\Controllers;

use App\Models\m_admin;
use App\Models\m_nota;
use App\Models\m_costumer;
use App\Models\m_item;

class Admin extends BaseController
{
    protected $m_admin;
    protected $m_nota;
    protected $m_costumer;
    protected $m_item;

    public function __construct()
    {
        date_default_timezone_set("Asia/Bangkok");

        $this->m_admin = new m_admin();
        $this->m_nota = new m_nota();
        $this->m_costumer = new m_costumer();
        $this->m_item = new m_item();
    }

    public function index()
    {

        if (session('id') != null) {
            $nota = $this->m_nota->getNota(false, false, 1);
            $pelanggan = $this->m_costumer->getUser();

            $data = [
                'subJudul' => 'Beranda',
                'tab_list' => [
                    'Beranda' => '',
                    'Pesanan' => 'admin/pesanan',
                    'Produk' => 'admin/produk',
                ],
                'nota' => $nota,
                'pelanggan' => $pelanggan
            ];

            return view('admin/dashboard', $data);
        } else {
            // jika session belum ter setting admin
            session()->setFlashdata('fail', '<p><b>DLogin terlebih dahulu.</b></p>');
            return redirect()->to('auth');
        }
    }

    public function profil()
    {
        if (session('id') == null) {
            return redirect()->to('/auth');
        } else {
            $data = [
                'subJudul' => 'Profil',
                'tab_list' => [
                    'Beranda' => '',
                    'Pesanan' => 'admin/pesanan',
                    'Produk' => 'admin/produk',
                ],
                'user' => $this->m_admin->getAdmin(session('id'))
            ];

            return view('admin/profil', $data);
        }
    }

    public function pesanan()
    {
        // periksa jika akun merupakan akun admin
        if (session('id') != null) {
            $nota = $this->m_nota->getNota();
            $pelanggan = $this->m_costumer->getUser();

            $data = [
                'subJudul' => 'Pesanan',
                'tab_list' => [
                    'Beranda' => '',
                    'Pesanan' => 'admin/pesanan',
                    'Produk' => 'admin/produk',
                ],
                'nota' => $nota,
                'pelanggan' => $pelanggan
            ];

            return view('admin/pesanan', $data);
        } else {
            // jika session belum ter setting admin
            session()->setFlashdata('fail', '<p><b>DLogin terlebih dahulu.</b></p>');
            return redirect()->to('auth');
        }
    }

    public function verifPesanan($id)
    {
        // periksa jika akun merupakan akun admin
        if (session('id') != null) {
            $nota = $this->m_nota->getNota(false, $id)[0];
            if ($nota['status'] == 1) {
                $hasil = $this->m_nota->update($id, [
                    'tgl' => date("Y-m-d H:i:s"),
                    'status' => 2
                ]);

                if ($hasil) {
                    session()->setFlashdata('success', '<p>Pesanan <b>berhasil dibatalkan</b>.</p>');
                } else {
                    session()->setFlashdata('fail', '<p>Pesanan <b>gagal dibatalkan</b>.</p>');
                }

                return redirect()->to('admin/pesanan');
            } else {
                // jika pesanan tidak berstatus dalam proses
                session()->setFlashdata('fail', '<p><b>Gagal memverifikasi pesanan.</b>Pastikan pesanan berstatus dalam proses atau tidak sedang dibatalkan</p>');
                return redirect()->to('admin/pesanan');
            }
        } else {
            // jika session belum ter setting admin
            session()->setFlashdata('fail', '<p><b>Login terlebih dahulu.</b></p>');
            return redirect()->to('auth');
        }
    }

    public function cancelPesanan($id)
    {
        // periksa jika akun merupakan akun admin
        if (session('id') != null) {
            $nota = $this->m_nota->getNota(false, $id)[0];
            if ($nota['status'] == 1) {
                $hasil = $this->m_nota->update($id, [
                    'tgl' => date("Y-m-d H:i:s"),
                    'status' => (-2)
                ]);

                if ($hasil) {
                    session()->setFlashdata('success', '<p>Pesanan <b>berhasil dibatalkan</b>.</p>');
                } else {
                    session()->setFlashdata('fail', '<p>Pesanan <b>gagal dibatalkan</b>.</p>');
                }

                return redirect()->to('admin/pesanan');
            } else {
                // jika pesanan tidak berstatus dalam proses
                session()->setFlashdata('fail', '<p><b>Gagal memverifikasi pesanan.</b>Pastikan pesanan berstatus dalam proses atau tidak sedang dibatalkan</p>');
                return redirect()->to('admin/pesanan');
            }
        } else {
            // jika session belum ter setting admin
            session()->setFlashdata('fail', '<p><b>Login terlebih dahulu.</b></p>');
            return redirect()->to('auth');
        }
    }

    public function undoPesanan($id)
    {
        // periksa jika akun merupakan akun admin
        if (session('id') != null) {
            $nota = $this->m_nota->getNota(false, $id)[0];
            if ($nota['status'] == (-2) || $nota['status'] == 2) {
                $hasil = $this->m_nota->update($id, [
                    'tgl' => date("Y-m-d H:i:s"),
                    'status' => 1
                ]);

                if ($hasil) {
                    session()->setFlashdata('success', '<p>Pesanan <b>berhasil dibatalkan</b>.</p>');
                } else {
                    session()->setFlashdata('fail', '<p>Pesanan <b>gagal dibatalkan</b>.</p>');
                }

                return redirect()->to('admin/pesanan');
            } else {
                // jika pesanan tidak berstatus dalam proses
                session()->setFlashdata('fail', '<p><b>Gagal memverifikasi pesanan.</b>Pastikan pesanan berstatus dalam proses atau tidak sedang dibatalkan</p>');
                return redirect()->to('admin/pesanan');
            }
        } else {
            // jika session belum ter setting admin
            session()->setFlashdata('fail', '<p><b>Login terlebih dahulu.</b></p>');
            return redirect()->to('auth');
        }
    }

    public function produk()
    {
        // periksa jika akun merupakan akun admin
        if (session('id') != null) {
            $item = $this->m_item->getItem();

            $data = [
                'subJudul' => 'Produk',
                'tab_list' => [
                    'Beranda' => '',
                    'Pesanan' => 'admin/pesanan',
                    'Produk' => 'admin/produk',
                ],
                'items' => $item
            ];

            return view('admin/produk', $data);
        } else {
            // jika session belum ter setting admin
            session()->setFlashdata('fail', '<p><b>Login terlebih dahulu.</b></p>');
            return redirect()->to('auth');
        }
    }

    // fungsi untuk memanggil formulir tambah produk
    public function tambahProduk()
    {
        // periksa jika akun merupakan akun admin
        if (session('id') != null) {
            $data = [
                'subJudul' => 'Tambah Produk',
                'tab_list' => [
                    'Beranda' => '',
                    'Pesanan' => 'admin/pesanan',
                    'Produk' => 'admin/produk',
                ],
                'validation' => \Config\Services::Validation()
            ];

            return view('admin/tambah', $data);
        } else {
            // jika session belum ter setting admin
            session()->setFlashdata('fail', '<p><b>Login terlebih dahulu.</b></p>');
            return redirect()->to('auth');
        }
    }

    // fungsi untuk menambahkan peroduk
    public function add()
    {
        // periksa jika akun merupakan akun admin
        if (session('id') != null) {
            // periksa jika akun merupakan akun admin
            if (session('id') != null) {
                // validasi input
                if (!$this->validate([
                    'nama_item' => [
                        'rules' => 'required',
                        'errors' => ['required' => 'Nama item harus diisi.']
                    ],
                    'deskripsi' => [
                        'rules' => 'required',
                        'errors' => ['required' => '{field} lahir harus diisi.']
                    ],
                    'harga' => [
                        'rules' => 'required',
                        'errors' => ['required' => '{field} harus diisi.']
                    ],
                    'kategori' => [
                        'rules' => 'required',
                        'errors' => ['required' => '{field} harus diisi.']
                    ],
                    'stok' => [
                        'rules' => 'required',
                        'errors' => ['required' => '{field} harus diisi.']
                    ]
                ])) {
                    return redirect()->to('admin/tambahProduk')->withInput();
                }

                $namaItem = $this->request->getVar('nama_item');
                $deskripsi = $this->request->getVar('deskripsi');
                $harga = $this->request->getVar('harga');
                $kategori = $this->request->getVar('kategori');
                $stok = $this->request->getVar('stok');

                $hasil = $this->m_item->save([
                    'nama_item' => $namaItem,
                    'deskripsi' => $deskripsi,
                    'harga' => $harga,
                    'kategori' => $kategori,
                    'stok' => $stok,
                    'gambar' => 'default.jpg'
                ]);

                if ($hasil) {
                    session()->setFlashdata('success', '<p><b>Produk Berhasil Diubah.</b></p>');
                } else {
                    session()->setFlashdata('fail', '<p><b>Produk Gagal Diubah.</b></p>');
                }
                return redirect()->to('admin/produk');
            } else {
                // jika session belum ter setting admin
                session()->setFlashdata('fail', '<p><b>Login terlebih dahulu.</b></p>');
                return redirect()->to('auth');
            }
        } else {
            // jika session belum ter setting admin
            session()->setFlashdata('fail', '<p><b>Login terlebih dahulu.</b></p>');
            return redirect()->to('auth');
        }
    }

    public function ubahProduk($id)
    {
        // periksa jika akun merupakan akun admin
        if (session('id') != null) {
            $item = $this->m_item->getItem($id);

            $data = [
                'subJudul' => 'Ubah Produk',
                'tab_list' => [
                    'Beranda' => '',
                    'Pesanan' => 'admin/pesanan',
                    'Produk' => 'admin/produk',
                ],
                'items' => $item,
                'validation' => \Config\Services::Validation()
            ];

            return view('admin/ubah', $data);
        } else {
            // jika session belum ter setting admin
            session()->setFlashdata('fail', '<p><b>Login terlebih dahulu.</b></p>');
            return redirect()->to('auth');
        }
    }

    public function edit($id)
    {
        // periksa jika akun merupakan akun admin
        if (session('id') != null) {
            // validasi input
            if (!$this->validate([
                'nama_item' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Nama item harus diisi.']
                ],
                'deskripsi' => [
                    'rules' => 'required',
                    'errors' => ['required' => '{field} lahir harus diisi.']
                ],
                'harga' => [
                    'rules' => 'required',
                    'errors' => ['required' => '{field} harus diisi.']
                ],
                'kategori' => [
                    'rules' => 'required',
                    'errors' => ['required' => '{field} harus diisi.']
                ],
                'stok' => [
                    'rules' => 'required',
                    'errors' => ['required' => '{field} harus diisi.']
                ]
            ])) {
                return redirect()->to('admin/ubahProduk/' . $id)->withInput();
            }

            $namaItem = $this->request->getVar('nama_item');
            $deskripsi = $this->request->getVar('deskripsi');
            $harga = $this->request->getVar('harga');
            $kategori = $this->request->getVar('kategori');
            $stok = $this->request->getVar('stok');

            $hasil = $this->m_item->update($id, [
                'nama_item' => $namaItem,
                'deskripsi' => $deskripsi,
                'harga' => $harga,
                'kategori' => $kategori,
                'stok' => $stok
            ]);

            if ($hasil) {
                session()->setFlashdata('success', '<p><b>Produk Berhasil Diubah.</b></p>');
            } else {
                session()->setFlashdata('fail', '<p><b>Produk Gagal Diubah.</b></p>');
            }
            return redirect()->to('admin/produk');
        } else {
            // jika session belum ter setting admin
            session()->setFlashdata('fail', '<p><b>Login terlebih dahulu.</b></p>');
            return redirect()->to('auth');
        }
    }

    public function hapusProduk($id)
    {
        // periksa jika akun merupakan akun admin
        if (session('id') != null) {
            $hasil = $this->m_item->delete($id);

            if ($hasil) {
                session()->setFlashdata('success', '<p><b>Berhasil menghapus produk.</b></p>');
            } else {
                session()->setFlashdata('fail', '<p><b>Gagal menghapus produk.</b></p>');
            }
            return redirect()->to('admin/produk');
        } else {
            // jika session belum ter setting admin
            session()->setFlashdata('fail', '<p><b>Login terlebih dahulu.</b></p>');
            return redirect()->to('auth');
        }
    }
}
