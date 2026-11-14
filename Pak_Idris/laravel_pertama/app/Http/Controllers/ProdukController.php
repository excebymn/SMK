<?php
namespace App\Http\Controllers;
use App\Http\Requests\UpdateProdukRequest;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Http\Resources\ProdukResource;
use App\Http\Resources\ProdukCollection;
use App\Http\Requests\StoreProdukRequest;
class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::paginate(10);
        return new ProdukCollection($produk);
    }


    public function show($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(
                ['message' => 'Produk tidak ditemukan'],

                404
            );
        }
        return new ProdukResource($produk);
    }

    public function store(StoreProdukRequest $request)
    {
        $produk = Produk::create($request->validated());
        $resource = new ProdukResource($produk);
        // validasi dan simpan produk
        return $resource->response()->setStatusCode(201);
    }
    public function update(UpdateProdukRequest $request, $id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(
                ['message' => 'Produk tidak ditemukan'],

                404
            );
        }
        $produk->update($request->validated());
        return new ProdukResource($produk);
    }
    public function destroy($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(
                ['message' => 'Produk tidak ditemukan'],

                404
            );
        }
        $produk->delete();
        // hapus produk
        return response()->json([
            'message' => "Produk {$id} berhasil dihapus"
        ], 200);
    }

}