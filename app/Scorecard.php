<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scorecard extends Model
{
    protected $fillable = ["scorecard_name","account_type_id","account_id","status","parent","is_updated","version","created_by"];

    public function account_type(){
    	return $this->hasOne("App\AccountType","id","account_type_id");
    }

    public function account(){
    	return $this->hasOne("App\Account","id","account_id");
    }

    public function parent(){
    	return $this->belongsTo('App\Scorecard');
    }

    public function children() {
        return $this->hasMany('App\Scorecard','parent','id') ;
    }

    public function grandchildren()
    {
        return $this->children()->with('grandchildren');
    }

    public function author(){
        return $this->hasOne("App\Employee","id","created_by");
    }
}
