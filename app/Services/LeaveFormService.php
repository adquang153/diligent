<?php

namespace App\Services;

use App\Models\LeaveForm;

class LeaveFormService{

    public function create($data){
        $user_id = auth()->user()->id;
        $data['user_id'] = $user_id;
        return LeaveForm::create($data);
    }

    public function list(){
        $list = LeaveForm::with('user')->orderBy('created_at','desc');
        return $list->paginate(10);
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