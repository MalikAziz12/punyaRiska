<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kasir extends Model
{
    use HasFactory;

    protected $fillable=[
        'patient_id',
        'gender',
        'address',
        'prescription',
        'harga',
        'pembayaran',

    ];
    public function patient(): BelongsTo
    {
        return $this->belongsTo(patient::class);
    }
    // public function nik(): BelongsTo
    // {
    //     return $this->belongsTo(patient::class);
    // }
    public function address(): HasMany
{
    return $this->hasMany(patient::class);
}

    public function getHargaIdrAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
