<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    protected array $produk = [
        ['id' => 1, 'nama' => 'Laptop', 'harga' => 8500000],
        ['id' => 2, 'nama' => 'Mouse', 'harga' => 200000],
        ['id' => 3, 'nama' => 'Keyboard', 'harga' => 300000],
    ];

    public function index()
    {
        return response()->json([
            'message' => 'Daftar Produk',
            'data' => $this->produk
        ]);
    }

    public function show($id) //cari dan tampilkan produk
    {
        $item = collect($this->produk)
            ->firstWhere('id', (int) $id);

        if (!$item) {
            return response()->json([
                'message' => 'Produk Tidak Ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Detail Produk Berhasil Diambil',
            'data' => $item 
        ]);
    }
    public function store(Request $request){ //validasi dan simpan produk
        return response()->json([
            'message' => 'roduk berhasil ditambahkan'
        ]);
    }
    public function update(Request $request, $id){ //validasi dan update produk
        return response()->json([
            'message' => "Produk {$id} berhasil diupdate"
        ], 200);
    } 
    public function destroy($id){ //hapus produk berdasarkan id
        return response()->json([
            'message' => "Produk {$id} berhasil dihapus"
        ], 200);
    }
}
