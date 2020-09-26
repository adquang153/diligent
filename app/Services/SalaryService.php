<?php

namespace App\Services;

use App\Models\SalaryAdvance;

class SalaryService{

    public function advance($type){
        $list = SalaryAdvance::with('user')->orderBy('created_at', 'desc');
        return $list->paginate(10);
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