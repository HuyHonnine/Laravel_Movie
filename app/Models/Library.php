<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'libraries';
    protected $fillable = [
        'image'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}