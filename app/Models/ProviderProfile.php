<?php

namespace App\Models;

use App\Models\Provider;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderProfile extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $table = 'providers_profiles';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'phone',
        'email',
        'website',
        'address',
        'logo',
        'provider',
        'website',
        'cr_number',
        'vat_number',
        'rate',
        'minimum_order',
        'payment_terms',
        'shipping_methods',
        'shipping_costs',
        'about',
    ];
    
    /**
     * The Provider type [] that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    
    public function fields($id) {
        return self::$fields[$id];
    }
    
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
