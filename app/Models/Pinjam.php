<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Pinjam extends Model
{
 protected $fillable = ['mahasiswa_id', 'buku_id', 'tanggal_pinjam', 'tanggal_kembali', 'status'];
 public function mahasiswa()
 {
 return $this->belongsTo(Mahasiswa::class);
 }
 public function buku()
 {
 return $this->belongsTo(Buku::class);
 }
 public function kembali()
 {
 return $this->hasOne(Kembali::class);
 }
}