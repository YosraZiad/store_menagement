<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name', 'arabic_name', 'iso2', 'iso3', 'call_code'
        // Add other fields as needed
    ];

    // Relationships (if applicable)
    // public function states()
    // {
    //     return $this->hasMany(State::class);
    // }

    // Scopes (if needed)
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}