<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalendarService;

class CalendarController extends Controller
{

    protected $calendar;

    public function __construct(CalendarService $calendar){
        $this->calendar = $calendar;
    }   
    
    public function index(){
        $list = $this->calendar->list();
        return view('view.calendar.index', compact('list'));
    }

    public function info($date){
        $list = $this->calendar->getWorkByDate($date);
        return view('view.calendar.info', compact('list', 'date'));
    }
}
