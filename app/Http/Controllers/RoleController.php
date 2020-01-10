<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Role;
class RoleController extends Controller
{
	protected $base_repo;

    public function __construct(BaseRepository $base_repo){
    	$this->base_repo = $base_repo;
    }

    public function __invoke(){
    	$roles = $this->base_repo->get(new Role);

    	return response(json_encode($roles),200);
    }
}
