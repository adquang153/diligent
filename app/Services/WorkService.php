<?php

namespace App\Services;

use Auth;
use App\Models\WorkInfo;
use App\Models\Work;

class WorkService{

    public function meeting($content){
        $user = Auth::user();
        $workInfo = $user->workInfo();
        if($workInfo === 1){
            $work_id = Work::select('id')->where('user_id', $user->id)->where('calendar_id', $user->checkMeeting()->id)->first()->id;
            return $user->work_info()->create([
                'meeting' => Now(),
                'work_id' => $work_id,
                'content' => $content
            ]);
        }
        return false;
    }

    public function report($content){
        $user = Auth::user();
        $workInfo = $user->workInfo();
        if($workInfo === 0){
            $work = $user->workInfo('info');
            $work->update([
                'content' => $content,
                'report' => Now(),
            ]);
            return $work;
        }
        return false;
    }

}

?>