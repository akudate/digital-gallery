<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'album';
    protected $fillable = [
        'nama',
        'deskripsi',
        'userid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
    public function foto()
    {
        return $this->hasMany(Foto::class, 'albumid');
    }
}
