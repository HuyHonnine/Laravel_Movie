<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_library extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_library';
    protected $fillable = [
        'product_id',
        'library_id',
    ];
}