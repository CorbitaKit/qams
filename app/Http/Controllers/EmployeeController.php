<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Http\Helper\ArrayConverter;
use App\Employee;
use DB;
use App\Events\EmployeeAccounts;
use App\AccountEmployee;
class EmployeeController extends Controller
{
    protected $base_repo;
    protected $array_converter;

    public function __construct(BaseRepository $base_repo, ArrayConverter $array_converter){
    	$this->base_repo = $base_repo;
    	$this->array_converter = $array_converter;
    }


    public function create(Request $request){
    	
    	$employee_data = $this->array_converter->transfromEmployeeData($request);

      

    	if($this->base_repo->create(new Employee,$employee_data)){
            $employee_id = DB::getPdo()->lastInsertId();
            event(new EmployeeAccounts($employee_id,$request->account_id));

    		return response("Created",201);
    	}
    }

    public function update(Request $request,$id){
        $employee_data = $this->array_converter->transfromEmployeeData($request);
        if($this->base_repo->update(new Employee,$employee_data,$id)){
            $this->base_repo->deleteRelation(new AccountEmployee,$id,"employee_id");

            event(new EmployeeAccounts($id,$request->account_id));

            return response("Updated",200);
        }
    }


    public function destroy($id){
        if($this->base_repo->delete(new Employee,$id)){
            return response("Deleted",200);
        }
    }

    public function getEmployees(){
    	$employees = $this->base_repo->getWith(new Employee,'role');

    	return response(json_encode($employees),200);
    }

    public function getEmployee($employee_id){
        $employee = $this->base_repo->getFirst(new Employee,"id",$employee_id);

        return response(json_encode($employee),200);
    }


    public function getEmployeeLoggedIn($id){

        $employee = $this->base_repo->getFirstWhereWith(new Employee,"role","employee_id",$id);

        return response(json_encode($employee),200);
    }

    public function getEmployeeAccounts($id){
        $employee_accounts = $this->base_repo->getWhere(new AccountEmployee,"employee_id",$id);

        return response(json_encode($employee_accounts),200);
    }


    public function checkEmployeeIfAdded($email){
        $employee = $this->base_repo->getFirst(new Employee,"email",$email);

        if(! $employee){
            return response("Not added",200);
        }

        return response("Already added",409);
    }
}
