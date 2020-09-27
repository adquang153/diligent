<?php

namespace App\Services;

use App\Models\SalaryAdvance;
use App\Models\User;

class SalaryService{

    public function advance($type){
        $user = \Auth::user();
        if($user->user_type == User::MANAGER)
            $list = SalaryAdvance::with('user');
        else
            $list = SalaryAdvance::where('user_id', $user->id);
        return $list->orderBy('created_at', 'desc')->paginate(10);
    }

    public function actionForm($data){
        $list = SalaryAdvance::select(['id','status'])->whereIn('id', $data['id']);
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