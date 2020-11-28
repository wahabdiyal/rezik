<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRegister extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function company()
    {
    	return $this->belongsTo(Company::class,'company_id');
    }

    public function skill()
    {
        return $this->morphMany('App\Models\Skill', 'skillable');
    }
}
