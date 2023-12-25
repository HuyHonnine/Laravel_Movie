<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
class GenreController extends Controller
{
    public function show_image_genre(Request $request)
    {
        $imagePath = $request->file('image')->store('uploads/genre');
        return response()->json(['imagePath' => $imagePath]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Genre::orderby('id', 'desc')->get();
        return view('admincp.genre.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.genre.form');
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
                'title' => 'required|unique:Genres|max:255',
                'slug' => 'required|unique:Genres|max:255',
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
        $genre = new Genre();
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->slug = $data['slug'];
        $genre->status = $data['status'];

        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/genre/', $new_image);
            $genre->image = $new_image;
        }

        $genre->save();
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
        $genre = Genre::find($id);
        return view('admincp.genre.form', compact('genre'));
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
        $genre = Genre::find($id);
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->slug = $data['slug'];
        $genre->status = $data['status'];

        $get_image = $request->file('image');

        if ($get_image) {
            $old_image_path = 'uploads/genre/' . $genre->image;
            if (file_exists($old_image_path)) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/genre/', $new_image);
                $genre->image = $new_image;
                unlink($old_image_path);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/genre/', $new_image);
                $genre->image = $new_image;
            }
        }

        $genre->save();
        toastr()->success('Thành Công','Cập nhật thành công');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genre::find($id);
        if(file_exists('uploads/genre/'.$genre->image)){
            unlink('uploads/genre/'.$genre->image);
        }
        $genre->delete();
        $genre->post()->delete();
        toastr()->success('Thành Công','Xóa thành công');
        return redirect()->back();
    }
}
