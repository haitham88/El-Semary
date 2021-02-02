<?php

namespace App;
use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use Translatable;
    protected $translatable = ["customer_code","first_name","middle_name","last_name","mobile","address"];
    protected $fillable = ["customer_code","first_name","middle_name","last_name","mobile","address", "serial_number"];
}
