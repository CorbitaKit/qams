<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Ztp;
use App\Http\Helper\ArrayConverter;
class ZTPController extends Controller
{
    protected $base_repo;
    protected $model;
    protected $helper;


    public function __construct(BaseRepository $base_repo, ArrayConverter $helper){

    	$this->base_repo = $base_repo;
    	$this->model = new Ztp;
    	$this->helper = $helper;
    }


    public function get(){
    	$ztps = $this->base_repo->getWith($this->model,['account','account_type']);

    	return response(json_encode($ztps),200);
    }

    public function create(Request $request){

    	$data = $this->helper->transformZTPDataToArray($request);

    	if($this->base_repo->create($this->model,$data)){

    		return response("created",201);
    	}
    }

    public function destroy($ztp_id){
        if($this->base_repo->delete($this->model,$ztp_id)){
            return response("Deleted",200);
        }
    }
}
