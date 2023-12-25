<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\storage_color;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Color::orderby('id','desc')->get();
        return view('admincp.color.form', compact('list'));
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
                'name' => 'required|unique:colors|max:255',
                'bg_color' => 'required|max:255',

            ],
            [
                'name.unique' => 'Tên đã có, xin điền tên khác',
                'name.required' => 'Tên không được để trống',
                'bg_color.required' => 'Màu nền không được để trống',
            ]
        );
        $color = new Color();
        $color->name = $data['name'];
        $color->bg_color = $data['bg_color'];
        $color->save();
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
        $color = Color::find($id);
        $list = Color::orderby('id','desc')->get();
        return view('admincp.color.form', compact('color','list'));
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
                'name' => 'required|max:255',
                'bg_color' => 'required|max:255',
            ],
            [
                'name.required' => 'Tên không được để trống',
                'bg_color.required' => 'Màu nền không được để trống',
            ]
        );
        $color = Color::find($id);
        $color->name = $data['name'];
        $color->bg_color = $data['bg_color'];

        $color->save();
        toastr()->success('Thành Công','Thêm thành công');
        return redirect()->route('color.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::find($id);
        storage_color::whereIN('color_id', [$color->id])->delete();
        $color->delete();
        toastr()->success('Thành Công','Xóa thành công');
        return redirect()->back();
    }
}