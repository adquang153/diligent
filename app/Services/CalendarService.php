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
            array_push($arr, ['workday' => Date( 'Y-m-' . $i ), 'count' => 0]);
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

}

?>