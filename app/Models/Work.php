<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $table = 'works';
    protected $fillable = ['user_id', 'calendar_id'];

    public function user(){
        return $this->belongsTo('App\Models\Contract');
    }

    public function calendar(){
        return $this->belongsTo('App\Models\Calendar');
    }
}
