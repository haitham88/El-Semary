<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function el3ohad()
    {
        return $this->hasOne(El3ohad::class);
    }
}
