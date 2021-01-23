<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ["id"];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, "orders_employees");
    }

    public function items()
    {
        return $this->belongsToMany(Employee::class, "orders_items");
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
