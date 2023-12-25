<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class PostController extends Controller
{
    public function show_image_post(Request $request)
    {
        $imagePath = $request->file('image')->store('uploads/post');
        return response()->json(['imagePath' => $imagePath]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Post::orderby('date_update', 'desc')->get();
        $genre = Genre::pluck('title', 'id');
        $user = User::pluck('name', 'id');
        return view('admincp.post.index', compact('list', 'genre','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genre = Genre::pluck('title', 'id');
        $user = User::pluck('name', 'id');
        return view('admincp.post.form', compact('genre','user'));
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
                'title' => 'required|unique:Posts|max:255',
                'slug' => 'required|unique:Posts|max:255',
                'meta' => 'required',
                'content' => 'required',
                'user_id' => 'required',
                'genre_id' => 'required',
                'status' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'title.unique' => 'Tên đã có, xin điền tên khác',
                'slug.unique' => 'Slug đã có, xin điền tên khác',
                'title.required' => 'Tên không được để trống',
                'slug.required' => 'Slug không được để trống',
                'meta.required' => 'Mô tả không được để trống',
                'content.required' => 'Nội dung không được để trống',
                'user_id.required' => 'Người viết không được để trống',
                'genre_id.required' => 'Thể loại không được để trống',
                'status.required' => 'Trạng thái không được để trống',
                'image.required' => 'Hình ảnh không được bỏ trống',
                'image.mimes' => 'Hình ảnh chỉ phù hợp với jpeg,jpg,gif,svg',
                'image.max' => 'Hình ảnh vượt quá 2MB',
            ]
        );
        $post = new post();
        $post->title = $data['title'];
        $post->meta = $data['meta'];
        $post->content = $data['content'];
        $post->genre_id = $data['genre_id'];
        $post->user_id = $data['user_id'];
        $post->slug = $data['slug'];
        $post->status = $data['status'];
        $post->date_create = Carbon::now('Asia/Ho_Chi_Minh');
        $post->date_update = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/post/', $new_image);
            $post->image = $new_image;
        }

        $post->save();
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
        $post = Post::find($id);
        $genre = Genre::pluck('title', 'id');
        $user = User::pluck('name', 'id');
        return view('admincp.post.form', compact('post', 'genre','user'));
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
                'meta' => 'required',
                'content' => 'required',
                'user_id' => 'required',
                'genre_id' => 'required',
                'status' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'title.required' => 'Tên không được để trống',
                'slug.required' => 'Slug không được để trống',
                'meta.required' => 'Mô tả không được để trống',
                'content.required' => 'Nội dung không được để trống',
                'user_id.required' => 'Người viết không được để trống',
                'genre_id.required' => 'Thể loại không được để trống',
                'status.required' => 'Trạng thái không được để trống',
                'image.required' => 'Hình ảnh không được bỏ trống',
                'image.mimes' => 'Hình ảnh chỉ phù hợp với jpeg,jpg,gif,svg',
                'image.max' => 'Hình ảnh vượt quá 2MB',
            ]
        );
        $post = Post::find($id);
        $post->title = $data['title'];
        $post->meta = $data['meta'];
        $post->content = $data['content'];
        $post->genre_id = $data['genre_id'];
        $post->user_id = $data['user_id'];
        $post->slug = $data['slug'];
        $post->status = $data['status'];
        $post->date_update = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->file('image');

        if ($get_image) {
            $old_image_path = 'uploads/post/' . $post->image;

            if (file_exists($old_image_path)) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/post/', $new_image);
                $post->image = $new_image;
                unlink($old_image_path);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/post/', $new_image);
                $post->image = $new_image;
            }
        }

        $post->save();
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
        $post = Post::find($id);
        if(file_exists('uploads/post/'.$post->image)){
            unlink('uploads/post/'.$post->image);
        }
        $post->delete();
        toastr()->success('Thành Công','Xóa bài viết thành công');
        return redirect()->back();
    }
}