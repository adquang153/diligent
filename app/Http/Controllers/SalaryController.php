<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SalaryService;

class SalaryController extends Controller
{

    protected $salary;

    public function __construct(SalaryService $salary){
        $this->salary = $salary;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->salary->advance('wait');
        return view('view.salary.advance', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('view.salary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);
        $user = \Auth::user();
        if( !$user->checkSalaryInMonth() ){
            if( !$user->salaryAdvance )
                return redirect()->back()->with('error', 'Không thể ứng lương khi mức lương bằng 0')->withInput();
            $result = $user->salary_advance()->create([
                'content' => $request->content,
                'amount' => $user->salaryAdvance
            ]);
            if($result)
                return redirect()->route('dashboard')->with('success', 'Đã gửi yêu cầu ứng lương đến quản lý!');
            return redirect()->back()->with('error', 'Yêu cầu ứng lương không thành công!')->withInput();
        }
        return redirect()->back()->with('error', 'Bạn đã ứng lương tháng này!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function action(Request $request){
        $request->validate([
            'id' => 'required',
            'type' => 'required|in:approval,delete'
        ]);
        $result = $this->salary->actionForm($request->all());
        if($request->type === 'delete'){
            if($result)
                return redirect()->back()->with('success', 'Xóa đơn nghỉ phép thành công!');
            return redirect()->back()->with('error', 'Xóa đơn nghỉ phép không thành công!');
        }
        if($result)
            return redirect()->back()->with('success', 'Duyệt đơn nghỉ phép thành công!');
        return redirect()->back()->with('error', 'Duyệt đơn nghỉ phép không thành công!');
    }
}
