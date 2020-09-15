<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LeaveFormRequest;
use App\Services\LeaveFormService;

class LeaveFormController extends Controller
{

    protected $leaveForm;

    public function __construct(LeaveFormService $leaveForm){
        $this->leaveForm = $leaveForm;
    }

    public function create(){
        return view('view.leave-form.create');
    }
    public function store(LeaveFormRequest $request){
        $result = $this->leaveForm->create($request->all());
        if($result)
            return redirect()->route('dashboard')->with('success', 'Gửi đơn thành công!');
        return redirect()->back()->withInput()->with('error', 'Gửi đơn không thành công!');
    }

    public function waiting(){
        $list = $this->leaveForm->listWaiting();
        return view('view.leave-form.waiting', compact('list'));
    }

    public function action(Request $request){
        $request->validate([
            'id' => 'required',
            'type' => 'required|in:approval,delete'
        ]);
        $result = $this->leaveForm->actionForm($request->all());
        if($request->type === 'delete'){
            if($result)
                return redirect()->route('leave-form.wait')->with('success', 'Xóa đơn nghỉ phép thành công!');
            return redirect()->route('leave-form.wait')->with('leave-form.wait', 'Xóa đơn nghỉ phép không thành công!');
        }
        if($result)
            return redirect()->route('leave-form.wait')->with('success', 'Duyệt đơn nghỉ phép thành công!');
        return redirect()->route('leave-form.wait')->with('leave-form.wait', 'Duyệt đơn nghỉ phép không thành công!');
    }

}
