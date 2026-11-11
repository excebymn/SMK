<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProdukCollection extends ResourceCollection
{
    /**
     * The resource that each item in the collection is formatted with.
     */
    public $collects = ProdukResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'total_data' => $this->total(),
                'per_halaman' => $this->perPage(),
                'halaman_saat_ini' => $this->currentPage(),
                'total_halaman' => $this->lastPage(),
            ],
        ];
    }
}
