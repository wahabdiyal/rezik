<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heading extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function headingable()
    {
        return $this->morphTo();
    }

}
