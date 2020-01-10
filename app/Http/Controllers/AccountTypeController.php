<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\AccountType;
class AccountTypeController extends Controller
{
	private $base_repo;
	private $model;
	public function __construct(BaseRepository $base_repo){
		$this->base_repo = $base_repo;
		$this->model = new AccountType;
	}
    public function get(){
    	$account_types = $this->base_repo->get($this->model);

    	return response(json_encode($account_types));
    }

    public function create(Request $request){
    	if($this->base_repo->create($this->model,["account_type_name" => $request->account_type_name])){
    		return response(json_encode('Created'),201);
    	}
    }

    public function update(Request $request,$id){
    	if($this->base_repo->update($this->model,["account_type_name" => $request->account_type_name],$id)){
    		return response(json_encode('Updated'),200);
    	}
    }

    public function destroy($id){
    	if($this->base_repo->delete($this->model,$id)){
    		return response(json_encode("Deleted"),200);
    	}
    }

    public function getAccountType($id){
        $account_type = $this->base_repo->getFirst($this->model,'id',$id);
        
        return response(json_encode($account_type),200);
    }
}
