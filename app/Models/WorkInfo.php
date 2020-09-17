<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkInfo extends Model
{
    use HasFactory;

    protected $table = 'work_info';
    protected $fillable = ['user_id', 'work_id', 'meeting', 'report', 'content'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function work(){
        return $this->belongsTo('App\Models\Works', 'work_id');
    }
}
