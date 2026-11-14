<?php
namespace App\Models;
use Database\Factories\ProdukFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/** @use HasFactory<ProdukFactory> */
class Produk extends Model
{
use HasFactory, softDeletes;

protected $fillable = ['nama_produk', 'harga', 'stok'];
}
