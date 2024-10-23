<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Provider extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $guard = 'admin';
    protected $table = 'providers';
    protected static $fields = [
        'Formal Cloths',
        'Sports Wear',
        'Sports Shoe',
        
    ];

    public $timestamps=true;
    
    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'short_name',
        'field',
        'status',
        'created_by',
        'updated_by',
    ];

    public function profile()
    {
        return $this->hasOne(ProviderProfile::class, 'provider');  
    }

    public function creator () {
        return $this->belongsTo (User::class, 'created_by');
    }

    public function editor () {
        return $this->belongsTo (User::class, 'updated_by');
    }

    public static function getFields() {
        return self::$fields;
    }


}
