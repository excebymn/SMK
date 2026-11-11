<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdukCollection;
use App\Http\Resources\ProdukResource;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a paginated listing of the resource.
     */
    public function index()
    {
        $produk = Produk::paginate(10);

        return new ProdukCollection($produk);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return new ProdukResource($produk);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: validate and save the product (meeting 7)
        return response()->json([
            'message' => 'Product created successfully',
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // TODO: validate and update the product (meeting 8)
        return response()->json([
            'message' => "Product {$id} updated successfully",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // TODO: delete the product (meeting 8)
        return response()->json([
            'message' => "Product {$id} deleted successfully",
        ], 200);
    }
}
