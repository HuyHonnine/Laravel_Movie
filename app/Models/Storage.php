<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function color(){
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function storage_color(){
        return $this->belongsToMany(Color::class, 'storage_color', 'storage_id','color_id' );
    }

    public function size(){
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function storage_size(){
        return $this->belongsToMany(Size::class, 'storage_size', 'storage_id','size_id' );
    }

    public function product(){
        return $this->belongsTo(product::class, 'product_id');
    }
}