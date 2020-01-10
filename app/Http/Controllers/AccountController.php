<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Account;
class AccountController extends Controller
{
	protected $base_repo;
	protected $model;

	public function __construct(BaseRepository $base_repo){
		$this->base_repo = $base_repo;
		$this->model = new Account;
	}
    public function get(){
    	$accounts = $this->base_repo->getWhere($this->model,'is_custom',0);

    	return response(json_encode($accounts),200);
    }

    public function getAccount($id){
    	$account = $this->base_repo->getFirst($this->model,'id',$id);

    	return response(json_encode($account),200);
    }

    public function getCustomAccount($id){

        $account = $this->base_repo->getWhereAndFirst($this->model,['id','is_custom'],[$id,1]);

        return response(json_encode($account),200);
    }
}
