<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medicine extends Model
{
    protected $table = 'medicines';

    protected $fillable = [
        'nama_obat',
        'harga',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    /**
     * Get all prescriptions for this medicine.
     */
    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }

    /**
     * Get all appointments that use this medicine (through prescriptions).
     */
    public function appointments()
    {
        return $this->belongsToMany(
            Appointment::class,
            'prescriptions',
            'medicine_id',
            'appointment_id'
        )->withPivot('jumlah')
            ->withTimestamps();
    }
}
