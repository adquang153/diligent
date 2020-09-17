<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WorkService;

class WorkController extends Controller
{

    protected $work;
    
    public function __construct(WorkService $work){
        $this->work = $work;
    }

    public function diligent(Request $request){
        $request->validate([
            'content' => 'required',
            'type' => 'required|in:meeting,report'
        ]);
        if($request->type === 'meeting'){
            $result = $this->work->meeting($request->content);
            if($result)
                return redirect()->route('dashboard')->with('success', 'Đã meeting!');
            return redirect()->back()->with('error', 'Bạn không trong ca làm việc này!');
        }
        else{
            $result = $this->work->report($request->content);
            if($result)
                return redirect()->route('dashboard')->with('success', 'Đã report!');
            return redirect()->back()->with('error', 'Đã quá giờ làm, không thể report!');
        }
        
    }
}
