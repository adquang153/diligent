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

    public function meeting(Request $request){
        $request->validate([
            'content' => 'required'
        ]);
        $result = $this->work->meeting($request->content);
        if($result){
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('error', 'Bạn không trong ca làm việc này!');
    }
}
