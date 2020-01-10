<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ztp extends Model
{
    protected $fillable = ["ztp_name","account_id","account_type_id"];

    public function account(){
    	return $this->hasOne("App\Account","id","account_id");
    }

     public function account_type(){
    	return $this->hasOne("App\AccountType","id","account_type_id");
    }
}
