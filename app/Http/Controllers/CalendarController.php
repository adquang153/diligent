<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalendarService;
use App\Services\UserService;
use App\Http\Requests\CalendarRequest;

class CalendarController extends Controller
{

    protected $calendar;
    protected $user;

    public function __construct(CalendarService $calendar, UserService $user){
        $this->calendar = $calendar;
        $this->user = $user;
    }   
    
    public function index(){
        $user = \Auth::user();
        if($user->user_type == \App\Models\User::MANAGER)
            $list = $this->calendar->list();
        else
            $list = $this->calendar->listByMember($user->id);
        return view('view.calendar.index', compact('list'));
    }

    public function info($date){
        $list = $this->calendar->getWorkByDate($date);
        return view('view.calendar.info', compact('list', 'date'));
    }

    public function create($date){
        if($date < Date('Y-m-d'))
            return redirect()->back()->with('error', 'Không thể tạo ca khi ngày nhỏ hơn hiện tại');
        $users = $this->user->getAll(['all']);
        return view('view.calendar.create', compact('date', 'users'));
    }

    public function store($date, CalendarRequest $request){
        if($date < Date('Y-m-d'))
            return redirect()->back()->with('Không thể tạo ca khi ngày nhỏ hơn hiện tại');
            
        if( intval($request->total) < count($request->users ?? []))
            return redirect()->back()->with('error', 'Số nhân viên được thêm không được vượt quá số lượng nhân viên của ca!')->withInput();

        $result = $this->calendar->createCalendar($date, $request->all());
        if($result)
            return redirect()->route('calendar.info', $date)->with('success', 'Tạo ca thành công!');
        return redirect()->back()->with('error', 'Lỗi khi tạo ca!')->withInput();
    }

    public function delete($id){
        $result = $this->calendar->deleteCalendar($id);
        if($result)
            return redirect()->back()->with('success', 'Đã xóa!');
        return redirect()->back()->with('error', 'Lỗi khi xóa ca!');
    }

    public function edit($id){
        $calendar = $this->calendar->findCalendar($id);
        $users = $this->user->getAll(['all']);
        return view('view.calendar.edit', compact('calendar', 'users'));
    }

    public function update($id, CalendarRequest $request){
        $result = $this->calendar->updateCalendar($id, $request->all());
        if($result)
            return redirect()->route('calendar.info', $result->workday)->with('success', 'Sửa ca thành công!');
        return redirect()->back()->with('error', 'Lỗi khi sửa ca!')->withInput();
    }
    
}
