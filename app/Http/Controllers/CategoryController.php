<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Category;
use App\Http\Helper\ArrayConverter;
class CategoryController extends Controller
{
    protected $base_repo;
    protected $model;
    protected $helper;
    public function __construct(BaseRepository $base_repo, ArrayConverter $array_converter){
    	$this->base_repo = $base_repo;
    	$this->model = new Category;
        $this->helper = $array_converter;
    }

    public function get(){
    	$categories = $this->base_repo->get($this->model);

    	return response(json_encode($categories),200);
    }

    public function create(Request $request){


    	if($this->base_repo->create($this->model,$this->helper->transformCategoryData($request))){
    		return response('Created',201);
    	}
    }

    public function destroy($id){

    	if($this->base_repo->delete($this->model,$id)){
    		return response('Deleted',200);
    	}
    }

    public function update(Request $request, $id){
        
        if($this->base_repo->update($this->model,$this->helper->transformCategoryData($request),$id)){
            return response('Updated',200);
        }
    }


    public function getCategory($id){
        $category = $this->base_repo->getFirst($this->model,'id',$id);

        return response(json_encode($category),200);
    }

    public function getCategoriesByAccountType($account_type){
        $categories = $this->base_repo->getWhere($this->model,'account_type',$account_type);

        return response(json_encode($categories));
    }


}
