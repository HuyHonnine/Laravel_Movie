<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\storage_size;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Size::orderby('id','desc')->get();
        return view('admincp.size.form', compact('list'));
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
                'title' => 'required|unique:sizes|max:255',
            ],
            [
                'name.unique' => 'Tên đã có, xin điền tên khác',
                'name.required' => 'Tên không được để trống',
            ]
        );
        $size = new Size();
        $size->title = $data['title'];
        $size->save();
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
        $size = Size::find($id);
        $list = Size::orderby('id','desc')->get();
        return view('admincp.size.form', compact('size','list'));
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
            ],
            [
                'name.required' => 'Tên không được để trống',
            ]
        );
        $size = Size::find($id);
        $size->title = $data['title'];
        $size->save();
        toastr()->success('Thành Công','Thêm thành công');
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
        $size = Size::find($id);
        storage_size::whereIN('size_id', [$size->id])->delete();
        $size->delete();
        toastr()->success('Thành Công','Xóa thành công');
        return redirect()->back();
    }
}