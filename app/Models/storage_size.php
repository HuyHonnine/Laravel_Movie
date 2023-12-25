<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class storage_size extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'storage_size';
    protected $fillable = [
        'storage_id',
        'size_id',
    ];
}