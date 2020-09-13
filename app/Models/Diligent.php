<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diligent extends Model
{
    use HasFactory;

    protected $table = 'diligents';
    protected $fillable = ['meeting', 'report', 'user_id'];

    public function user(){
        return $this->belongsTo('App\Models\Contract');
    }
}
