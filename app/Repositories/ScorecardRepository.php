<?php
	
	namespace App\Repositories;
	use App\ParameterAccountType;
	use App\Repositories\BaseRepository;
	use App\Http\Helper\ArrayConverter;
	use App\Account;
	use App\AccountType;
	use App\Scorecard;
	use App\ScorecardBody;
	use DB;
	class ScorecardRepository{

		protected $base_repo;
		protected $model;
		protected $helper;
		public function __construct(BaseRepository $base_repo,ArrayConverter $helper){
			$this->base_repo = $base_repo;
			$this->model = new Scorecard;
			$this->helper = $helper;
		}
		

		public static function getAccountTypeParameter($account_type_id){

			$base_repo = new BaseRepository;

			$account_type_parameters = $base_repo->getWhere(new ParameterAccountType,'account_type_id',$account_type_id);

			$parameter_id = array();

			foreach($account_type_parameters as $account_type_parameter){
				array_push($parameter_id,$account_type_parameter->parameter_id);
			}

			return $parameter_id;
		}


		public function generateName($account_type_id, $account_id){
			
			$scorecard_name = '';

			$account_name = self::getAccountName($account_id);
			$account_type_name = self::getAccountTypeName($account_type_id);


			
			$scorecard = $this->base_repo->getWhereAnd($this->model,['account_type_id','account_id','is_updated'],[$account_type_id,$account_id,0]);

		
			if(count($scorecard) > 0){
				$scorecard_name = $account_name.'-'.$account_type_name.'-00'.(string)(count($scorecard)+1);
			}else{
				$scorecard_name = $account_name.'-'.$account_type_name.'-001';
			}

			return $scorecard_name;

		} 

		private function getAccountName($account_id){


			$account = $this->base_repo->getFirst(new Account,'id',$account_id);

			return $account->account_name;
		}

		private function getAccountTypeName($account_type_id){
			$account_type = $this->base_repo->getFirst(new AccountType,'id',$account_type_id);

			return $account_type->account_type_name;
		}

		public function storeScorecardBody($bodies,$scorecard_id){

			for($i = 0; $i < count($bodies['category']); $i++){
				self::extractParams($bodies['category'][$i],$scorecard_id);
			}
	
		}

		private function extractParams($body,$scorecard_id){
			for($i = 0; $i < count($body["parameters"]); $i++){
				$data = $this->helper->transformScorecardBodyToArray($body["parameters"][$i],$scorecard_id,$body["id"]);

				$this->base_repo->create(new ScorecardBody,$data);
			}
			
		}


		public function countScorecardVersion($id,$ctr=0){

			$scorecard = $this->base_repo->getFirst(new Scorecard,'id',$id);

			if($scorecard->parent == 0){
				return $ctr;
			}else{
				return $this->countScorecardVersion($scorecard->parent,$ctr+1);
			}


		}


		public function checkForCustomAccount($account){
			if(gettype($account) == 'string'){
				
				$this->base_repo->create(new Account,["account_name" => $account, "is_custom" => 1]);

				return DB::getPdo()->lastInsertId();
			}

			return $account;
		}





	}
?>