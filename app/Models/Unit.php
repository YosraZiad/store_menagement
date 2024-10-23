<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'units';
    protected $fillable = ['name', 'description', 'short_name', 'created_at', 'updated_at', 'created_by', 'updated_by'];
}

