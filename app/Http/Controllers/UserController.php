<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;

class UserController extends Controller
{
    public function show_image_user(Request $request)
    {
        $imagePath = $request->file('image')->store('uploads/user');
        return response()->json(['imagePath' => $imagePath]);
    }

    public function edit_password($id){
        $user = User::find($id);
        return view('admincp.user.change', compact('user'));
    }

    public function update_password(Request $request, $id) {
        $data = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ',
            'password.required' => 'Mật khẩu mới không được để trống',
            'password.min' => 'Mật khẩu mới không dưới 8 ký tự',
            'password.confirmed' => 'Mật khẩu mới không trùng khớp',
        ]);

        // Lấy thông tin người dùng và kiểm tra mật khẩu cũ
        $user = User::find($id);
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Mật khẩu cũ không đúng']);
        }

        // Cập nhật mật khẩu mới
        $user->password = bcrypt($request->input('password'));
        $user->save();

        toastr()->success('Thành Công', 'Cập nhật tài khoản thành công');
        return redirect()->back();
    }



    public function profile_user($id){
        $user = User::find($id);
        return view('admincp.user.profile', compact('user'));
    }

    public function update_image_user_ajax(Request $request){
        $get_image = $request -> file('file');
        $user_id = $request -> user_id;

        if($get_image){
            // xoa anh cu
            $user = User::find($user_id);
            unlink('uploads/user/'.$user->image);

            // them anh moi
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/user/',$new_image);
            $user->image = $new_image;
            $user->save();
        }
    }

    public function edit_user($id){
        $user = User::find($id);
        return view('admincp.user.update', compact('user'));
    }

    public function update_user(Request $request, $id){
        $data = $request->validate(
            [
                'email' => 'required|max:255',
                'name' => 'required|max:255',
                'description' => 'required',
                'birthday' => 'required',
                'phone' => 'required|string|max:10',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'name.required' => 'Tên không được để trống',
                'email.required' => 'Email không được để trống',
                'birthday.required' => 'Ngày sinh không được để trống',
                'description.required' => 'Mô tả không được để trống',
                'phone.required' => 'Số điện thoại không được để trống',
                'phone.string' => 'Số điện thoại phải là một chuỗi',
                'phone.max' => 'Số điện thoại không được vượt quá :max ký tự',
                'image.required' => 'Hình ảnh không được bỏ trống',
                'image.mimes' => 'Hình ảnh chỉ phù hợp với jpeg,jpg,gif,svg',
                'image.max' => 'Hình ảnh vượt quá 2MB',
            ]
        );
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->description = $data['description'];
        $user->phone = $data['phone'];
        $user->birthday = $data['birthday'];
        $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->file('image');
        if ($get_image) {
            $old_image_path = 'uploads/user/' . $user->image;
            if (file_exists($old_image_path)) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/user/', $new_image);
                $user->image = $new_image;
                unlink($old_image_path);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/user/', $new_image);
                $user->image = $new_image;
            }
        }
        $user->save();
        toastr()->success('Thành Công','Cập nhật tài khoản thành công');
        return redirect()->back();
    }

    public function assign_role($id){
        $user = User::find($id);

        if ($user) {
            $roles = $user->roles;

            if ($roles->isNotEmpty()) {
                $name_roles = $roles->first()->name;
                $all_colum_roles = $roles->first();
            } else {
                $name_roles = null;
                $all_colum_roles = null;
            }
        } else {
            abort(404);
        }

        $list_role = Role::orderBy('id', 'DESC')->get();

        return view('admincp.user.assign_roles', compact('user', 'list_role', 'name_roles', 'all_colum_roles'));
    }

    public function insert_role($id, Request $request){
        $data = $request->all();
        $user = User::find($id);
        $user->syncRoles([$data['role']]);
        toastr()->success('Thành Công', 'Cấp vai trò thành công');
        return redirect()->route('user.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = User::with('roles','permissions')->orderby('id','DESC')->get();
        return view('admincp.user.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.user.form');
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
                'email' => 'required|unique:users|max:255',
                'name' => 'required|max:255',
                'description' => 'required',
                'slug' => 'required|max:255',
                'birthday' => 'required',
                'status' => 'required',
                'password' => 'required|min:8|confirmed',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'phone' => 'required|string|max:10',
            ],
            [
                'name.required' => 'Tên không được để trống',
                'password.required' => 'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu không dưới 8 ký tự',
                'password.confirmed' => 'Mật khẩu không trùng khớp',
                'email.unique' => 'Email đã tồn tại, xin điền email khác',
                'email.required' => 'Email không được để trống',
                'image.required' => 'Hình ảnh không được bỏ trống',
                'image.mimes' => 'Hình ảnh chỉ phù hợp với jpeg,jpg,gif,svg',
                'image.max' => 'Hình ảnh vượt quá 2MB',
                'birthday.required' => 'Ngày sinh không được để trống',
                'status.required' => 'Trạng thái không được để trống',
                'description.required' => 'Mô tả không được để trống',
                'phone.required' => 'Số điện thoại không được để trống',
                'phone.string' => 'Số điện thoại phải là một chuỗi',
                'phone.max' => 'Số điện thoại không được vượt quá :max ký tự',
            ]
        );
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($request->input('password'));
        $user->description = $data['description'];
        $user->slug = $data['slug'];
        $user->phone = $data['phone'];
        $user->birthday = $data['birthday'];
        $user->status = $data['status'];


        $user->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image -> move('uploads/user/', $new_image);
            $user->image = $new_image;
        }
        $user->save();
        toastr()->success('Thành Công','Thêm tài khoản thành công');
        return redirect()->route('user.index');
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
        $user = User::find($id);
        return view('admincp.user.form', compact('user'));
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
                'email' => 'required|max:255',
                'name' => 'required|max:255',
                'description' => 'required',
                'slug' => 'required|max:255',
                'birthday' => 'required',
                'status' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'phone' => 'required|string|max:10',
            ],
            [
                'name.required' => 'Tên không được để trống',
                'email.required' => 'Email không được để trống',
                'image.required' => 'Hình ảnh không được bỏ trống',
                'image.mimes' => 'Hình ảnh chỉ phù hợp với jpeg,jpg,gif,svg',
                'image.max' => 'Hình ảnh vượt quá 2MB',
                'birthday.required' => 'Ngày sinh không được để trống',
                'status.required' => 'Trạng thái không được để trống',
                'description.required' => 'Mô tả không được để trống',
                'phone.required' => 'Số điện thoại không được để trống',
                'phone.string' => 'Số điện thoại phải là một chuỗi',
                'phone.max' => 'Số điện thoại không được vượt quá :max ký tự',
            ]
        );
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->description = $data['description'];
        $user->slug = $data['slug'];
        $user->phone = $data['phone'];
        $user->birthday = $data['birthday'];
        $user->status = $data['status'];

        $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->file('image');

        if ($get_image) {
            $old_image_path = 'uploads/user/' . $user->image;

            if (file_exists($old_image_path)) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/user/', $new_image);
                $user->image = $new_image;
                unlink($old_image_path);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/user/', $new_image);
                $user->image = $new_image;
            }
        }
        $user->save();
        toastr()->success('Thành Công','Cập nhật tài khoản thành công');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(file_exists('uploads/user/'.$user->image)){
            unlink('uploads/user/'.$user->image);
        }
        $user->delete();
        toastr()->success('Thành Công','Xóa tài khoản thành công');
        return redirect()->back();
    }
}