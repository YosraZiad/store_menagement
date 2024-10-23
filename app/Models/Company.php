<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    public $timestamps=true;
    protected $table='companies';
    protected $fillable=['name', 'address', 'company_size' ,'phone_number','incorporation_date', 'industry','website' ,'created_at', 'updated_at', 'created_by', 'updated_by'   ];
}
