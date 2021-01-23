<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function processes()
    {
        return $this->belongsToMany(Process::class, "sub_categories_processes");
    }

}
