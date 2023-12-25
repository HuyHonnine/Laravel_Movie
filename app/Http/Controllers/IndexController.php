<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Storage;
use App\Models\storage_color;
use App\Models\Color;
use App\Models\storage_size;
use App\Models\Size;

class IndexController extends Controller
{
    public function home(){
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        $product = Product::with('category','product_library', 'brand','library')->orderBy('date_update', 'DESC')->where('status', 1)->paginate(20);
        return view('pages.home', compact('category','product'));
    }

    public function product($slug){
        $product = Product::with('category','product_library', 'brand','library')->where('slug', $slug)->first();
        $storage = Storage::with('product','storage_color', 'color', 'size', 'storage_size')->orderby('id', 'desc')->get();
        return view('pages.product', compact('product', 'storage'));
    }
}