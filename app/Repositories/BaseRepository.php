<?php  

	namespace App\Repositories;

	class BaseRepository{

		protected $static_model;

		public function get($model){
			return $model::get();
		}

		public function create($model,$data){
			return $model::create($data);
		}

		public function getWith($model,$relation){
			return $model::with($relation)->get();
		}

		public function delete($model,$id){
			return $model::where("id",$id)->delete();
		}

		public function update($model,$data,$id){
			return $model::where("id",$id)->update($data);
		}

		public function getFirst($model,$field,$id){
			return $model::where($field,$id)->first();
		}

		public function getFirstWhereWith($model,$relation,$field,$attrib){
			return $model::with($relation)->where($field,$attrib)->first();
		}

		public function getWhere($model,$field,$attribs){
			return $model::where($field,$attribs)->get();
		}

		public function getWhereWith($model,$field,$attribs,$relation){
			return $model::with($relation)->where($field,$attribs)->orderBy('id', 'desc')->get();
		}

		public function getWhereAnd($model,$fields,$attribs){
			return $model::where($fields[0],$attribs[0])
			              ->where($fields[1],$attribs[1])
			              ->where($fields[2],$attribs[2])
			              ->get();

			// for($i = 0; $i < count($fields)-1;$i++){
			// 	$model = $model->where($fields[$i],$attribs[$i]);
			// }

			// return $model->get();
		}

		public function getWhereIn($model,$fields,$attribs){

			return $model::where($fields[0],$attribs[0])
			             ->whereIn($fields[1],$attribs[1])
			             ->get();
		}

		public function getWhereAndFirst($model,$fields,$attribs){
			return $model::where($fields[0],$attribs[0])
			             ->where($fields[1],$attribs[1])
			             ->first();
		}

		public function deleteRelation($model,$id,$field){
			return $model::where($field,$id)->delete();
		}


	}



?>