<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountEmployee extends Model
{
    protected $fillable = ["employee_id",'account_id'];

    protected $table = "account_employee";
}
