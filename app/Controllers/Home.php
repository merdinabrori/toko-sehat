<?php

namespace App\Controllers;

use App\Models\m_item;

class Home extends BaseController
{
    protected $m_item;

    public function __construct()
    {
        $this->m_item = new m_item();
    }

    public function index()
    {
        $tab_list = [
            'Beranda' => '',
            'Kontak' => 'home/kontak',
            'Tentang' => 'home/tentang'
        ];

        if (session('uid') != null) {
            $tab_list = [
                'Beranda' => '',
                'Keranjang' => 'costumer/keranjang',
                'Pembelian' => 'costumer/nota',
                'Kontak' => 'home/kontak',
                'Tentang' => 'home/tentang'
            ];
        }

        $data = [
            'subJudul' => 'Beranda',
            'tab_list' => $tab_list,
            'items' => $this->m_item->getItem()
        ];

        if (session('id') == null) {
            return view('beranda/home', $data);
        } else {
            return redirect()->to('admin');
        }
    }

    public function kontak()
    {
        $data = [
            'subJudul' => 'Kontak',
            'tab_list' => [
                'Beranda' => '',
                'Kontak' => 'home/kontak',
                'Tentang' => 'home/tentang'
            ]
        ];

        return view('beranda/kontak', $data);
    }

    public function tentang()
    {
        $data = [
            'subJudul' => 'Tentang',
            'tab_list' => [
                'Beranda' => '',
                'Kontak' => 'home/kontak',
                'Tentang' => 'home/tentang'
            ]
        ];

        return view('beranda/tentang', $data);
    }

    public function detail($id_item)
    {
        $data = [
            'subJudul' => 'Produk',
            'tab_list' => [
                'Beranda' => '',
                'Kontak' => 'home/kontak',
                'Tentang' => 'home/tentang'
            ],
            'item' => $this->m_item->getItem($id_item)
        ];

        return view('beranda/detail', $data);
        d($data);
    }
}
