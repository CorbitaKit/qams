<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AccountType;
class Parameter extends Model
{
    protected $fillable = ["parameter_name","description","category_id","account_type_id"];

    public function category(){
    	return $this->hasOne("App\Category","id","category_id");
    }

    // public function account_type(){
    // 	return $this->hasOne("App\AccountType","id","account_type_id");
    // }

    public function account_types(){
    	return $this->belongsToMany(AccountType::class);
    }
}
