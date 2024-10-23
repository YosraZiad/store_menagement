<?php

namespace App\Models;

use Laratrust\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    public $guarded = [];

    public $timestamp = true;

    protected $table = 'permissions';

    protected $fillable = [ 
        'name',
        'display_name',
        'brief',
        'created_by',
        'updated_by',
    ];

    public function creator () {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor () {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
