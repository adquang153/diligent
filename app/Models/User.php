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
            return 'quản lý';
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

}
