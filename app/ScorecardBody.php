<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScorecardBody extends Model
{
    protected $fillable = ["scorecard_id","category_id","parameter_id","weight"];


    public function category(){
    	return $this->hasMany("App\Category","id","category_id");
    }

    public function parameter(){
    	return $this->hasMany("App\Parameter","id","parameter_id");
    }
}
