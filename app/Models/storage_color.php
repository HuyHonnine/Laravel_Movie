<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class storage_color extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'storage_color';
    protected $fillable = [
        'storage_id',
        'color_id',
    ];
}