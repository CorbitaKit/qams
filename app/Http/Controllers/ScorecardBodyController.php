<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ScorecardBody;
use App\Repositories\BaseRepository;
class ScorecardBodyController extends Controller
{
    protected $base_repo;
    protected $model;

    public function __construct(BaseRepository $base_repo){
    	$this->base_repo = $base_repo;

    	$this->model = new ScorecardBody;
    }


    public function getScorecardBody($id){

    	$scorecard_bodies = $this->base_repo->getWhereWith($this->model,'scorecard_id',$id,'category');

    	return response(json_encode($scorecard_bodies),200);
    }

    public function getScorecardBodyParameter($cat_id,$scorecard_id){
    	$scorecard_parameters = ScorecardBody::with('parameter')
    										 ->where('scorecard_id',$scorecard_id)
    										 ->where('category_id',$cat_id)
    										 ->get();
    	return response(json_encode($scorecard_parameters),200);
    }
}
