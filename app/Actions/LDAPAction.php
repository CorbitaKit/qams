<?php  
	
	namespace App\Actions;
	use Adldap\AdldapInterface;

	class LDAPAction{

		protected $ldap;

		public function __construct(AdldapInterface $ldap){
			$this->ldap = $ldap;
		}

		public function getLdapUser($key){
			return $this->ldap->search()->orWhere('name','starts_with',$key)
    					              ->orWhere("samaccountname","starts_with",$key)
    					       
    					              ->get();

		}

	}



?>