<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ["customer_code","first_name","middle_name","last_name","mobile","address"];
}
