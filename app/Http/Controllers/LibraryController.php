<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use App\Models\product_library;

class LibraryController extends Controller
{
    public function store_image_library_ajax(Request $request){
        $library = new Library();
        $get_image = $request->file('image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/library/',$new_image);
            $library->image = $new_image;
            $library->save();
        }

        return response()->json(['success' => true, 'message' => 'Image added successfully']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list= Library::orderby('id', 'desc')->get();
        return view('admincp.library.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.library.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request -> all();
        $library = new Library();

        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image -> move('uploads/library/', $new_image);
            $library->image = $new_image;
        }
        $library->save();
        toastr()->success('Thành Công','Thêm hình ảnh thành công');
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
        $library = Library::find($id);
        return view('admincp.library.form',compact('library'));
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
        $data = $request->all();
        $library = Library::find($id);
        $get_image = $request->file('image');

        if ($get_image) {
            $old_image_path = 'uploads/library/' . $library->image;
            if (file_exists($old_image_path)) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/library/', $new_image);
                $library->image = $new_image;
                unlink($old_image_path);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/library/', $new_image);
                $library->image = $new_image;
            }
        }

        $library->save();
        toastr()->success('Thành Công','Cập nhật hình ảnh thành công');
        return redirect()->route('library.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $library = Library::find($id);
        //xoa anh
        if(file_exists('uploads/library/'.$library->image)){
            unlink('uploads/library/'.$library->image);
        }
        product_library::whereIN('library_id', [$library->id])->delete();
        $library->delete();
        toastr()->success('Thành Công','Xóa phim thành công');
        return redirect()->back();
    }
}