<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService{

    public function create($data){
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function getAll(){
        $list = User::where('user_type', User::MEMBER)->orderBy('full_name', 'desc')->paginate(15);
        return $list;
    }

}

?>