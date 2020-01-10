<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterAccountType extends Model
{
    protected $fillable = ['parameter_id','account_type_id'];

    protected $table = 'account_type_parameter';
}
