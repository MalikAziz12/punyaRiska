<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientAppointment extends Model
{
    use HasFactory;
    protected $fillable=[
        'patient_id',
        'doktor_id',
        'date_of_appoinment',
        'note',
        'prescription',
        'status'
    ];
    public function doktor(): BelongsTo
    {
        return $this->belongsTo(User::class,'doktor_id')->whereHas('roles', function($query){
            $query->where('name','dokter');
        });
    }
    public function patient(): BelongsTo
    {
        return $this->belongsTo(patient::class);
    }
}
