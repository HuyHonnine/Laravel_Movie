<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function show_image_brand(Request $request)
    {
        $imagePath = $request->file('image')->store('uploads/brand');
        return response()->json(['imagePath' => $imagePath]);
    }

    // update anh bang ajax
    public function update_image_brand_ajax(Request $request){
        $get_image = $request -> file('file');
        $brand_id = $request -> brand_id;

        if($get_image){
            // xoa anh cu
            $brand = Brand::find($brand_id);
            unlink('uploads/brand/'.$brand->image);

            // them anh moi
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/brand/',$new_image);
            $brand->image = $new_image;
            $brand->save();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Brand::orderby('position','asc')->get();
        return view('admincp.brand.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.brand.form');
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
                'title' => 'required|unique:brands|max:255',
                'slug' => 'required|unique:brands|max:255',
                'description' => 'required|unique:brands|max:255',
                'status' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'title.unique' => 'Tên đã có, xin điền tên khác',
                'slug.unique' => 'Slug đã có, xin điền tên khác',
                'title.required' => 'Tên không được để trống',
                'slug.required' => 'Slug không được để trống',
                'description.required' => 'Mô tả không được để trống',
                'status.required' => 'Trạng thái không được để trống',
                'image.required' => 'Hình ảnh không được bỏ trống',
                'image.required' => 'Hình ảnh không được bỏ trống',
                'image.mimes' => 'Hình ảnh chỉ phù hợp với jpeg,jpg,gif,svg',
                'image.max' => 'Hình ảnh vượt quá 2MB',
            ]
        );

        $brand = new Brand();
        $brand->title = $data['title'];
        $brand->slug = $data['slug'];
        $brand->description = $data['description'];
        $brand->status = $data['status'];

        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image -> move('uploads/brand/', $new_image);
            $brand->image = $new_image;
        }

        $brand->save();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admincp.brand.form', compact('brand'));
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
                'title' => 'required|max:255',
                'slug' => 'required|max:255',
                'description' => 'required',
                'status' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'title.required' => 'Tên không được để trống',
                'slug.required' => 'Slug không được để trống',
                'description.required' => 'Mô tả không được để trống',
                'status.required' => 'Trạng thái không được để trống',
                'image.required' => 'Hình ảnh không được bỏ trống',
                'image.mimes' => 'Hình ảnh chỉ phù hợp với jpeg,jpg,gif,svg',
                'image.max' => 'Hình ảnh vượt quá 2MB',
            ]
        );        $brand = Brand::find($id);
        $brand->title = $data['title'];
        $brand->slug = $data['slug'];
        $brand->description = $data['description'];
        $brand->status = $data['status'];

        $get_image = $request->file('image');

        if ($get_image) {
            $old_image_path = 'uploads/brand/' . $brand->image;
            if (file_exists($old_image_path)) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/brand/', $new_image);
                $brand->image = $new_image;
                unlink($old_image_path);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/brand/', $new_image);
                $brand->image = $new_image;
            }
        }

        $brand->save();
        toastr()->success('Thành Công','Cập nhật thương hiệu thành công');
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if(file_exists('uploads/brand/'.$brand->image)){
            unlink('uploads/brand/'.$brand->image);
        }
        $brand->delete();
        $brand->product()->delete();
        toastr()->success('Thành Công','Xóa thương hiệu thành công');
        return redirect()->back();
    }
}