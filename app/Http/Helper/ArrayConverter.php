<?php  

	namespace App\Http\Helper;
	use Illuminate\Support\Facades\Auth;

	class ArrayConverter{

		public function transfromEmployeeData($data){
			$employee_data = array(
				"name" => $data->name,
				"email" => $data->email,
				"employee_id" => $data->employee_id,
				"role_id" => $data->role_id
			);

			return $employee_data;
		}

		public function transformCategoryData($data){
			$category_data = array(
				"category_name" => $data->category_name,
			);

			return $category_data;
		}

		public function transformParameterDataToArray($data){
			$parameter_data = array(
				"parameter_name" => $data->parameter_name,
				"description" => $data->description,
				"category_id" => $data->category_id,
			);

			return $parameter_data;
		}

		public function transformScoreCardDataToArray($data,$name,$parent_id,$is_updated,$version,$account_id){
			$scorecard_data = array(
				"scorecard_name" => $name,
				"account_type_id" => $data["account_type_id"],
				"account_id" => $account_id,
				"status" => Auth::user()->employee->role->name == 'Manager' ? 1 : 0,
				"parent" => $parent_id,
				"is_updated" => $is_updated,
				"version" => $version,
				"created_by" => Auth::user()->employee->id
			);
			return $scorecard_data;
		}

		public function transformScorecardBodyToArray($params,$scorecard_id,$category_id){
			$scorecard_body_data = array(
				"scorecard_id" => $scorecard_id,
				"category_id" => $category_id,
				"parameter_id" => $params["id"],
				"weight" => $params["weight"],
				
			);

			return $scorecard_body_data;
		}

		public function transformZTPDataToArray($request){
			$ztp_data = array(
				"ztp_name" => $request->ztp_name,
				"account_id" => $request->account_id,
				"account_type_id" => $request->account_type_id
			);

			return $ztp_data;
		}

	}

?>