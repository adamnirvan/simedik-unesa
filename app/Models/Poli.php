<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poli extends Model
{
    protected $table = 'polis';

    protected $fillable = [
        'nama_poli',
    ];

    /**
     * Get all users (doctors) for this poli.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all appointments for this poli.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
