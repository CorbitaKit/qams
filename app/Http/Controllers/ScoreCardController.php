<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scorecard;
use App\Repositories\BaseRepository;
use App\Http\Helper\ArrayConverter;
use App\Repositories\ScorecardRepository;
use DB;
use Gate;
use Auth;
class ScoreCardController extends Controller
{
	protected $base_repo;
	protected $helper;
	protected $model;

	public function __construct(BaseRepository $base_repo, ArrayConverter $helper,ScorecardRepository $scorecard_repo){
		$this->base_repo = $base_repo;
		$this->helper = $helper;
		$this->model = new Scorecard;
		$this->scorecard_repo = $scorecard_repo;
	}


	public function get(){
		$scorecards = $this->base_repo->getWhereWith($this->model,"is_updated",0,["account_type","account","author"]);

		return response(json_encode($scorecards),200);
	}

    public function getScorecard($id){
        $scorecard = $this->base_repo->getFirst($this->model,'id',$id);

        return response(json_encode($scorecard),200);
    }

    public function create(Request $request){

        $account_id = $this->scorecard_repo->checkForCustomAccount($request->header['account_id']);

    	$scorecard_name = $this->scorecard_repo->generateName($request->header["account_type_id"],$account_id);

        

        self::generateScorecard($request,$scorecard_name,0,0,1,$account_id);

        return response('created',201);
    	
    	
    }


    public function update(Request $request){
        // $scorecards = $this->base_repo->getWhereWith($this->model,'parent',1,'children.grandchildren');
        $account_id = $this->scorecard_repo->checkForCustomAccount($request->header['account_id']);

        $version = $this->scorecard_repo->countScorecardVersion($request->header['id']);


        self::generateScorecard($request,$request->header['name'],$request->header['id'],0,($version+2),$account_id);

        $this->base_repo->update($this->model,["is_updated" => 1],$request->header['id']);


        return response('created',201);




    }


    private function generateScorecard($request,$scorecard_name,$parent_id,$is_updated,$version,$account_id){
        $data = $this->helper->transformScoreCardDataToArray($request->header,$scorecard_name,$parent_id,$is_updated,$version,$account_id);

        

        if($this->base_repo->create($this->model,$data)){
            $scorecard_id = DB::getPdo()->lastInsertId();

            $this->scorecard_repo->storeScorecardBody($request->body,$scorecard_id);

            return response("Created",201);

        }
    }


    public function getName($account_id,$account_type_id){
    	$scorecad_name = $this->scorecard_repo->generateName($account_type_id,$account_id);

    	// return response($scorecad_name,200);

    	return response(json_encode($scorecad_name),200);
    }

    public function setScorecardStatus($id,$status){
        
        if(Gate::allows('approve-scorecard-status')){
            if($this->base_repo->update($this->model,['status' => $status],$id)){
                return response('Updated',200);
            }
        }else{
            return response('Unauthorized',403);
        }
    }

    public function destroy($id){
        if(Auth()->user()->employee->role->name == 'Manager') {
            if($this->base_repo->delete($this->model,$id)){
                return response(json_encode("Deleted"),200);
            }
        }else{
            return response('Unauthorized',403);
        }
    }
}
