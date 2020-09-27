<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileRequest;

class MemberController extends Controller
{

    protected $user;

    public function __construct(UserService $user){
        $this->user = $user;
    }
    public function index(){
        $list = $this->user->getAll();
        return view('view.member.index', compact('list'));
    }
    public function create(){
        return view('view.member.create');
    }

    public function store(RegisterRequest $request){
        $user = $this->user->create($request->all());
        if($user){
            return redirect()->route('dashboard')->with('success', 'Tạo '.$user->position.' thành công!');
        }
        return redirect()->back()->with('error', 'Lỗi khi tạo '.$user->position);
    }

    public function me(){
        return view('view.member.profile');
    }

    public function profile($id){
        $user = $this->user->detail($id);
        return view('view.member.profile', compact('user'));
    }

    public function delete(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $result = $this->user->delete($request->id);
        if($result)
            return redirect()->back()->with('success', 'Xóa nhân viên thành công!');
        return redirect()->back()->with('error', 'Xóa nhân viên không thành công!');
    }

    public function changePassword(){
        return view('view.member.change-password');
    }

    public function changePasswordConfirm(ChangePasswordRequest $request){
        $result = $this->user->changePassword($request->all());
        if($result)
            return redirect()->route('dashboard')->with('success', 'Đổi mật khẩu thành công!');
        return redirect()->back()->with('error', 'Mật khẩu cũ không đúng!');
    }

    public function editProfile($id){
        $user = $this->user->detail($id);
        return view('view.member.edit', compact('user'));
    }

    public function updateProfile($id, ProfileRequest $request){
        $result = $this->user->updateProfile($id, $request->all());

        if($result)
            return redirect()->route('dashboard')->with('success', 'Cập nhật thành công!');
        return redirect()->back()->with('error', 'Cập nhật không thành công!');
    }

}
