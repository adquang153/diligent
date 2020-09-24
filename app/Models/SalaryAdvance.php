<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryAdvance extends Model
{
    use HasFactory;

    protected $table = 'salary_advance';
    protected $fillable = ['user_id', 'amount', 'status'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
