<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;
class Account extends Model
{
    protected $fillable = ["account_name","is_custom"];

    public function employees(){
    	return $this->belongsToMany(Employee::class);
    }
}
