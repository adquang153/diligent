<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'contracts';
    protected $fillable = ['user_id', 'role', 'salary', 'date_start', 'date_end'];


    public function user(){
        return $this->belongsTo('App\Models\Contract');
    }
}
