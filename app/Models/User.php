<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const MANAGER = 'manager';
    const MEMBER = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password', 'user_type', 'address', 'phone', 'avatar', 'academic_level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPositionAttribute()
    {
        if($this->user_type === User::MANAGER){
            return 'quản trị viên';
        }
        return 'nhân viên';
    }

    public function works(){
        return $this->hasMany('App\Models\Work');
    }

    public function calendar()
    {
        return $this->belongsToMany('App\Models\Calendar', 'works', 'user_id', 'calendar_id');
    }

    public function checkMeeting(){
        return $this->calendar()
                ->whereDate('workday', Date('Y-m-d'))
                ->where('start_time', '<=', Date('H:i:s'))
                ->where('end_time','>=',Date('H:i:s'))
                ->first();
    }

    public function work_info(){
        return $this->hasMany('App\Models\WorkInfo');
    }

    public function workInfo($type=""){
        $checkMeeting = $this->checkMeeting();
        if($checkMeeting){
            $work_id = Work::select('id')->where('user_id', $this->id)->where('calendar_id', $checkMeeting->id)->first()->id;
            $work_info = WorkInfo::select('id','meeting','report','content')->where('user_id', $this->id)->where('work_id', $work_id)->first();
            if($type === 'info')
                return $work_info;
            if(!$work_info){
                // Chưa meeting thì trả về 1
                return 1;
            }
            if(!$work_info->report){
                // Đã meeting nhưng chưa report thì trả về 0
                return 0;
            }
            // Đã hết cả làm thì trả về 2
            return 2;
        }
        // Không có ca làm việc hiện tại thì trả về -1
        return -1;
    }

    public function leave_forms(){
        return $this->hasMany('App\Models\LeaveForm');
    }

    public function contract(){
        return $this->hasOne('App\Models\Contract');
    }

    public function salary_advance(){
        return $this->hasMany('App\Models\SalaryAdvance');
    }

    public function salaryAdvance($month, $year){
        $salary = optional($this->contract)->salary ?? 0;
        $money = $salary / 26;
        $money_total = $money * $this->work_info()->whereBetween('created_at', [Date("$year-$month-01"), Date("$year-$month-t")])->count();
        return $money_total;
    }
    
    public function checkSalaryInMonth(){
        return $this->salary_advance()->whereBetween('created_at', [Date('Y-m-01'), Date('Y-m-t')])->count();
    }

}
