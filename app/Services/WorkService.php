<?php

namespace App\Services;

use Auth;
use App\Models\WorkInfo;
use App\Models\Work;

class WorkService{

    public function meeting($content){
        $user = Auth::user();
        $checkMeeting = $user->checkMeeting();
        if($checkMeeting){
            $work_id = Work::select('id')->where('user_id', $user->id)->where('calendar_id', $checkMeeting->id)->first()->id;
            return $user->work_info()->create([
                'start_time' => Now(),
                'work_id' => $work_id,
                'content' => $content
            ]);
        }
        return false;
    }

}

?>