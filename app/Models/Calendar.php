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
}
