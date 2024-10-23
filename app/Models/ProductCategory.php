<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    public $timestamps=true;
    protected $table='products_categories';
    protected $fillable=['name', 'brief', 'parent' ,'created_at', 'updated_at', 'created_by', 'updated_by'   ];
}
