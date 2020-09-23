<?php

namespace App\Services;

use App\Models\Calendar;

class CalendarService{

    public function list(){
        $select = \DB::raw("workday, Count(id) as count");
        $list = Calendar::select($select)
                            ->whereBetween('workday', [Date('Y-m-01'), Date('Y-m-t')])
                            ->distinct('workday')
                            ->groupBy('workday')
                            ->get();
        $arr = [];
        for( $i = 1; $i <= Date('t'); $i++){
            $day = "0". $i;
            $day = substr($day, -2);
            array_push($arr, ['workday' => Date( 'Y-m-' . $day ), 'count' => 0]);
        }
        $list = $list->toArray();
        if(!empty($list) && count($list))
            foreach($arr as $index => $item){
                foreach($list as $calendar){
                    if($item['workday'] == $calendar['workday'])
                        $arr[$index] = $calendar;
                }
            }
        return $arr;
    }

    public function getWorkByDate($date){
        if( $date < Date('Y-m-01') || $date > Date('Y-m-t') ){
            abort(404);
        }
        $list = Calendar::withCount('works')->whereDate('workday', $date)->get();
        return $list;
    }

    public function createCalendar($date, $data){
        $data['workday'] = $date;
        $calendar = Calendar::create($data);
        if($calendar && count($data['users'] ?? []) > 0){
            $calendar->members()->sync($data['users']);
        }
        return $calendar;
    }

    public function deleteCalendar($id){
        $calendar = $this->findCalendar($id);
        return $calendar->delete();
    }

    public function findCalendar($id){
        $calendar = Calendar::with('works')->find($id);
        return $calendar;
    }

    public function updateCalendar($id, $data){
        $calendar = $this->findCalendar($id);
        $time = Date('Y-m-d H:i:s', strtotime( $calendar->workday . $calendar->start_time ));
        
        // Nếu thời gian bắt đầu ca lớn hơn thời gian hiện tại thì không cho sửa
        if($time < Date('Y-m-d H:i:s'))
            return false;
        if($calendar){
            $calendar->update($data);
            if($calendar && count($data['users'] ?? []) > 0){
                $calendar->members()->sync($data['users']);
            }
            return $calendar;
        }
        return false;
    }

}

?>