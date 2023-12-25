<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function library(){
        return $this->belongsTo(Library::class, 'library_id');
    }
    public function product_library(){
        return $this->belongsToMany(Library::class, 'product_library', 'product_id','library_id' );
    }

    public function storage(){
        return $this->hasMany(Storage::class)->orderBy('id','DESC');
    }

}
