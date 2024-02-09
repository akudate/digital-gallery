<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $fillable = [
        'fotoid',
        'userid',
        'isi',
    ];

    public function foto()
    {
        return $this->belongsTo(Foto::class, 'fotoid');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
