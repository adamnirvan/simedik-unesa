<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    protected $guarded = [];
    
    protected $table = 'appointments';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'poli_id',
        'tanggal_pengajuan',
        'waktu_jadwal',
        'status',
        'keluhan',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'waktu_jadwal' => 'datetime',
    ];

    /**
     * Get the patient (user) for this appointment.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * Get the doctor (user) for this appointment.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /**
     * Get the poli for this appointment.
     */
    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class);
    }

    /**
     * Get all prescriptions for this appointment.
     */
    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }

    /**
     * Get all medicines prescribed for this appointment (through prescriptions).
     */
    public function medicines()
    {
        return $this->belongsToMany(
            Medicine::class,
            'prescriptions',
            'appointment_id',
            'medicine_id'
        )->withPivot('jumlah')
            ->withTimestamps();
    }
}
