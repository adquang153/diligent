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

    public function getAll($params=[]){
        $list = User::where('user_type', User::MEMBER)->orderBy('full_name', 'desc');
        if(isset($params['all']))
            $list = $list->get();
        else
            $list = $list->paginate(15);
        return $list;
    }

    public function detail($id){
        $user = User::find($id);
        if(!$user)
            abort(404);
        return $user;
    }

    public function delete($ids){
        $list = User::select('id')->whereIn('id', $ids);
        return $list->delete();
    }

}

?>