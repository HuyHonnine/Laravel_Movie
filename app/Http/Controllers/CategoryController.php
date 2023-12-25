<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show_image_category(Request $request)
    {
        $imagePath = $request->file('image')->store('uploads/category');
        return response()->json(['imagePath' => $imagePath]);
    }

    public function resorting_cate(Request $request){
        $data = $request -> all();
        foreach ($data['array_id'] as $key => $value) {
            $category = Category::find($value);
            $category->position = $key;
            $category -> save();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Category::orderby('position','ASC')->get();
        return view('admincp.category.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.category.form');
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
                'title' => 'required|unique:categories|max:255',
                'slug' => 'required|unique:categories|max:255',
                'description' => 'required',
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
                'image.mimes' => 'Hình ảnh chỉ phù hợp với jpeg,jpg,gif,svg',
                'image.max' => 'Hình ảnh vượt quá 2MB',
            ]
        );

        $category = new Category();
        $category->title = $data['title'];
        $category->description = $data['description'];
        $category->slug = $data['slug'];
        $category->status = $data['status'];

        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/category/', $new_image);
            $category->image = $new_image;
        }

        $category->save();
        toastr()->success('Thành Công','Thêm Danh mục thành công');
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
        $category = Category::find($id);
        return view('admincp.category.form',compact('category'));
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
        );
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->description = $data['description'];
        $category->slug = $data['slug'];
        $category->status = $data['status'];

        $get_image = $request->file('image');

        if ($get_image) {
            $old_image_path = 'uploads/category/' . $category->image;

            if (file_exists($old_image_path)) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/category/', $new_image);
                $category->image = $new_image;
                unlink($old_image_path);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/category/', $new_image);
                $category->image = $new_image;
            }
        }
        $category->save();
        toastr()->success('Thành Công','Cập nhật danh mục thành công');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(file_exists('uploads/category/'.$category->image)){
            unlink('uploads/category/'.$category->image);
        }
        $category->delete();
        $category->product()->delete();
        toastr()->success('Thành Công','Xóa Danh mục thành công');
        return redirect()->back();
    }
}
