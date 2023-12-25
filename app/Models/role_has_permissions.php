<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role_has_permissions extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'role_has_permissions';
    protected $fillable = [
        'color_id',
        'permission_id',
    ];
}