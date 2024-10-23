<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    public $timestamps=true;

    protected $table='products';
    
    protected $fillable=['name', 'description' ,'barcode','price','category', 'unit','created_at', 'updated_at', 'created_by', 'updated_by'   ];
}
