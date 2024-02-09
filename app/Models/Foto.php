<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'foto';
    protected $fillable = [
        'judul',
        'deskripsi',
        'file',
        'albumid',
        'userid',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'albumid');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
