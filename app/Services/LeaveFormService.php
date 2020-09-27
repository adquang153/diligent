<?php

namespace App\Services;

use App\Models\LeaveForm;
use App\Models\User;

class LeaveFormService{

    public function create($data){
        $user_id = auth()->user()->id;
        $data['user_id'] = $user_id;
        return LeaveForm::create($data);
    }

    public function list(){
        $user = \Auth::user();
        if($user->user_type == User::MANAGER)
            $list = LeaveForm::with('user');
        else
            $list = LeaveForm::where('user_id', $user->id);
        return $list->orderBy('created_at','desc')->paginate(10);
    }

    public function actionForm($data){
        $list = LeaveForm::select(['id','status'])->whereIn('id', $data['id']);
        if($data['type'] === 'delete')
            return $list->delete();
        $list = $list->get();
        foreach($list as $item){
            $item->status = 1;
            $item->save();
        }
        return true;
    }

}

?>