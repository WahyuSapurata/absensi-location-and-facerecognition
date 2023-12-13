<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class JamKerja extends Model
{
    use HasFactory;

    protected $table = 'jam_kerjas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'hari',
        'jam_masuk',
        'jam_pulang',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk membuat UUID sebelum menyimpan
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
