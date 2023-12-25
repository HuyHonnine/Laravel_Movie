<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storage;
use App\Models\Product;
use App\Models\storage_color;
use App\Models\Color;
use App\Models\storage_size;
use App\Models\Size;
class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Storage::with('product','storage_color', 'color', 'size', 'storage_size')->orderby('id', 'desc')->get();
        return view('admincp.storage.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_product = Product::orderBy('id','DESC')->pluck('title','id');

        $color = Color::pluck('bg_color','id');
        $list_color = Color::orderByDesc('id')->get();

        $size = Size::pluck('title','id');
        $list_size= Size::orderByDesc('id')->get();
        return view('admincp.storage.form', compact('list_color', 'color', 'list_product', 'size', 'list_size'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'quantity' => 'required',
                'product_id' => 'required',
                'color' => 'required|array',
                'size' => 'required|array',
            ],
            [
                'quantity.required' => 'Số lượng không được bỏ trống',
                'product_id.required' => 'Tên sản phẩm không được bỏ trống',
                'color.required' => 'Màu sắc không được bỏ trống',
                'size.required' => 'Kích cỡ không được bỏ trống',
            ]
        );
        $storage = new Storage();
        $storage->quantity = $data['quantity'];
        $storage->product_id = $data['product_id'];

        foreach($data['color'] as $key => $col){
            $storage->color_id = $col[0];
        }

        foreach($data['size'] as $key => $siz){
            $storage->size_id = $siz[0];
        }

        $storage->save();
        $storage->storage_color()->attach($data['color']);
        $storage->storage_size()->attach($data['size']);

        toastr()->success('Thành Công','Thêm thành công');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $storage = Storage::find($id);
        $list_product = Product::orderBy('id','DESC')->pluck('title','id');

        $color = Color::pluck('name','id');
        $list_color = Color::orderByDesc('id')->get();

        $size = Size::pluck('title','id');
        $list_size= Size::orderByDesc('id')->get();

        $storage_size = $storage->storage_size;
        $storage_color = $storage->storage_color;

        return view('admincp.storage.form', compact('list_color', 'color', 'list_product','storage','list_size','size','storage_color','storage_size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'quantity' => 'required|numeric',
                'product_id' => 'required',
                'color' => 'required|array',
                'size' => 'required|array',
            ],
            [
                'quantity.required' => 'Số lượng không được bỏ trống',
                'product_id.required' => 'Tên sản phẩm không được bỏ trống',
                'color.required' => 'Màu sắc không được bỏ trống',
                'quantity.numeric' => 'Số lượng phải là một số',
                'size.required' => 'Kích cỡ không được bỏ trống',
            ]
        );
        $storage = Storage::find($id);
        $storage->quantity = $data['quantity'];
        $storage->product_id = $data['product_id'];

        foreach($data['color'] as $key => $col){
            $storage->color_id = $col[0];
        }

        foreach($data['size'] as $key => $siz){
            $storage->size_id = $siz[0];
        }

        $storage->save();
        $storage->storage_color()->sync($data['color']);
        $storage->storage_size()->sync($data['size']);

        toastr()->success('Thành Công','Sửa thành công');
        return redirect()->route('storage.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storage = Storage::find($id);
        storage_color::whereIN('storage_id', [$storage->id])->delete();
        storage_size::whereIN('storage_id', [$storage->id])->delete();
        $storage->delete();
        toastr()->success('Thành Công','Xóa sản phẩm thành công');
        return redirect()->back();
    }
}