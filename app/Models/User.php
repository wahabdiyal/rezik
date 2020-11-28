<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lname',
        'email',
        'password',
        'phone',
    'skill',
    'address',
        'resume',
        'gender',
    'age',
        'city',
        'district',
    'country',
        'experience',
        'key_skills',
    'image',
        'desired_state',
        'desired_district',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function skills()
    {
        return $this->morphMany('App\Models\Skill', 'skillable');
    }
      public function experiences()
    {
        return $this->morphMany('App\Models\Experience', 'experienceable');
    }
    public function education()
    {
        return $this->morphMany('App\Models\Education', 'educationable');
    }
     public function skill_detail()
    {
        return $this->morphOne('App\Models\SkillDetail', 'skill_detailable');
    }
    public function summary()
    {
        return $this->morphOne('App\Models\Summary', 'summaryable');
    }
    public function heading()
    {
        return $this->morphOne('App\Models\Heading', 'headingable');
    }
     public function file()
    {
        return $this->morphOne('App\Models\File', 'fileable');
    }
}
