<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public $timestamps=true;
    protected $table='brands';
    protected $fillable=['name', 'description', 'brand_logo' ,'country_origin','website','company_id','created_at', 'updated_at', 'created_by', 'updated_by'   ];
}

