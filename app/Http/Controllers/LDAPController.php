<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\LDAPAction;
class LDAPController extends Controller
{
	protected $ldap_action;

	public function __construct(LDAPAction $ldap_action){
		$this->ldap_action = $ldap_action;
	}
    public function __invoke($key){
    	
    	$users = $this->ldap_action->getLdapUser($key);
    	return response(json_encode($users),200);
    }
}