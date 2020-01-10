<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Parameter;
class AccountType extends Model
{
    protected $fillable = ["account_type_name"];

    public function parameters(){
    	return $this->belongsToMany(Parameter::class);
    }
}
