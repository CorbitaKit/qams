<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parameter;
use App\Repositories\BaseRepository;
use App\Repositories\ScorecardRepository;
use App\Http\Helper\ArrayConverter;
use DB;
use App\Events\ParameterAccountTypes;
class ParameterController extends Controller
{
    protected $base_repo;
    protected $model;
    protected $helper;

    public function __construct(BaseRepository $base_repo,ArrayConverter $array_converter){
    	$this->base_repo = $base_repo;
    	$this->model = new Parameter;
        $this->helper = $array_converter;
    }

    public function get(){

    	$parameters = $this->base_repo->getWith($this->model,['category','account_types']);

    	return response(json_encode($parameters),200);
    }

    public function create(Request $request){
        
        $data = $this->helper->transformParameterDataToArray($request);
        // DB::beginTransaction();

        // try{
            if($this->base_repo->create($this->model,$data)){
                $parameter_id = DB::getPdo()->lastInsertId();

                event(new ParameterAccountTypes($parameter_id,$request->account_type_id));
                return response('Created',201);
            }
        // }catch(\Exception $e){

        //     DB::rollback();
        // }
    	
    }

    public function destroy($id){

    	if($this->base_repo->delete($this->model,$id)){
    		return response('Deleted',200);
    	}
    }

    public function update(Request $request,$id){
        $data = $this->helper->transformParameterDataToArray($request);

        if($this->base_repo->update($this->model,$data,$id)){
            return response("Updated",200);
        }
    }

  
    public function getParameterByCategoryAndAccountType($category_id,$account_type_id){

        $parameter_ids = ScorecardRepository::getAccountTypeParameter($account_type_id);

        $parameters = $this->base_repo->getWhereIn($this->model,['category_id','id'],[$category_id,$parameter_ids]);


        return response(json_encode($parameters));
    }
}
