<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Order extends Model
{
    use Translatable;
    protected $translatable = ["price","status"];
    protected $guarded = ["id"];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, "orders_employees");
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, "orders_items");
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
