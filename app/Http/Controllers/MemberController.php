<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;

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
}
