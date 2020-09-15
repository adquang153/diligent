<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveForm extends Model
{
    use HasFactory;

    protected $table = 'leave_form';
    protected $fillable = ['user_id', 'content', 'day_off', 'status'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
