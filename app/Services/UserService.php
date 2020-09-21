<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService{

    public function create($data){
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        if($user){
            return $user->contract()->create([
                'role' => $data['role'],
                'salary' => $data['salary'],
                'date_start' => $data['date_start'],
                'date_end' => $data['date_end']
            ]);
        }
        return false;
    }

    public function getAll(){
        $list = User::where('user_type', User::MEMBER)->orderBy('full_name', 'desc')->paginate(15);
        return $list;
    }

}

?>