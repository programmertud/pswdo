<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildInfo extends Model
{
    protected $fillable = ['name', 'age', 'lgu_name', 'category'];
}
