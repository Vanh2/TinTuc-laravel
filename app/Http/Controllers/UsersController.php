<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// đối tượng mã hoá password
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Section;

// trong controller muốn sử dụng đối tượng nào thì phải khai báo ở đây
// đối tượng thao tác csdl


//thực hiện Query Builder: sử dụng đối tượng DB

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:add user|update user|delete user|read user', ['only' => ['read']]);
        $this->middleware('permission:add user', ['only' => ['create']]);
        $this->middleware('permission:update user', ['only' => ['update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function read(Request $request)
    {
        //paginate(5) -> phân 5 bản ghi trên 1 trang
        // $data = DB::table("users")
        // Permission::create(['name' => 'read new']);
        // $role = Role::find(2);
        // $permission = Permission::find(8);
        // $role->givePermissionTo($permission);
        // gọi view

        // $user = User::find(11);
        // $user->givePermissionTo('add user');
        // $user->getPermissionsViaRoles();
        // dd($user);
        // $user->hasRole('writer');
        $user = User::with(['roles', 'permissions'])->orderBy("id", "desc")->paginate(10);
        // dd($user);
        return view("backend.users_read", compact('user'));
    }
    //update get
    public function update($id)
    {
        // tạo 1 action để đưa vào thuộc tính action của thẻ form
        $action = url("/users/update/$id");
        // lấy 1 bản ghi
        //first() -> lấy 1 bản ghi
        $record = DB::table("users")->where("id", "=", $id)->first();
        return view("backend.users_create_update", ["record" => $record, "action" => $action]);
    }
    //update post
    public function updatePost($id)
    {
        $name = request("name");
        $password = request("password");
        // update name
        DB::table("users")->where("id", "=", $id)->update(["name" => $name]);
        // nếu password không rỗng thì update password
        if ($password != "") {
            //mã hoá password
            $password = Hash::make($password);
            DB::table("users")->where("id", "=", $id)->update(["password" => $password]);
        }
        //di chuyển đến 1 url khác
        return redirect(url("/users"));
    }
    //create get
    public function create()
    {
        //tạo 1 action để đưa vào thuộc tính của thẻ form
        $action = url("/users/create");
        return view("backend.users_create_update", ["action" => $action]);
    }
    //create post
    public function createPost()
    {
        $email = request("email");
        $name = request("name");
        $position = request("position");
        $password = request("password");
        //mã hoá password
        $password = Hash::make($password);
        //kiểm tra xem email đã tồn tại chưa, nếu chưa tồn tại thì mới cho insert 
        $countEmail = DB::table("users")->where("email", "=", $email)->Count();
        //Count() -> trả về số lượng bản ghi
        if ($countEmail == 0) {
            //update name
            DB::table("users")->insert(["name" => $name, "email" => $email, "password" => $password]);
            //di chuyển đến 1 url khác
            return redirect(url("/users"));
        } else
            return redirect(url("/users/create?notify=emailExists"));
    }
    //delete
    public function delete($id)
    {
        //lấy 1 bản ghi
        //first() -> lấy 1 bản ghi
        DB::table("users")->where("id", "=", $id)->delete();
        //di chuyển đến 1 url khác
        return redirect(url("/users"));
    }
    // phân vai trò
    public function role($id)
    {
        $user = User::find($id);
        $role = Role::orderBy("id", "desc")->get();
        $rolesnow = $user->roles->first();
        $permission = Permission::orderBy('id', 'desc')->get();
        return view('backend.users_roles', compact('user', 'role', 'rolesnow', 'permission'));
    }

    public function insert_roles(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        $user->syncRoles($data['role']);
        $role_id = $user->roles->first()->id;
        return redirect()->back()->with('status', 'thêm vai trò thành công');
    }

    public function create_roles(Request $request)
    {
        $data = $request->all();
        $roles = new Role();
        $roles->name = $data['roles'];
        $roles->save();
        return redirect()->back()->with('status', 'tạo vai trò thành công');
    }

    // phân quyền 
    public function permission($id)
    {
        $user = User::find($id);
        $permission = Permission::orderBy('id', 'desc')->get();
        $name_roles = $user->roles->first()->name;
        $get_permission_via_role = $user->getPermissionsViaRoles();
        return view('backend.users_permission', compact('user', 'name_roles', 'permission', 'get_permission_via_role'));
    }

    public function insert_permission(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        $role_id = $user->roles->first()->id;
        $role = Role::find($role_id);
        $role->syncPermissions($data['permission']);
        return redirect()->back()->with('status', 'thêm quyền thành công');
    }

    public function create_permission(Request $request)
    {
        $data = $request->all();
        $permission = new Permission();
        $permission->name = $data['permission'];
        $permission->save();
        return redirect()->back()->with('status', 'tạo mới quyền thành công');
    }
}