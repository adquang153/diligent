<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'calendars';
    protected $fillable = ['start_time', 'end_time', 'workday', 'total'];


    public function works(){
        return $this->hasMany('App\Models\Work');
    }

    public function members(){
        return $this->belongsToMany('App\Models\User', 'works', 'calendar_id', 'user_id');
    }
}
