<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillDetail extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function skill_detailable()
    {
        return $this->morphTo();
    }
}
