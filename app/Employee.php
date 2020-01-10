<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;
class Employee extends Model
{
    protected $fillable = ["name","email","employee_id","role_id"];


    public function role(){
    	return $this->hasOne("App\Role","id","role_id");
    }

    public function accounts(){
    	return $this->belongsToMany(Account::class);
    }
}
