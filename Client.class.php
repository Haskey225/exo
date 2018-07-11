<?php
	class Client
	{
		private $_id,
				$_clientid,
				$_socityname,
				$_email,
				$_activity,
				$_address,
				$_tel,
				$_mobile,
				$_country,
				$_city,
				$_street,
				$_credit;
	// Constantes
		const ERREUR_CLIENTS = 'le client n\'existe pas dans la base de donnée';
		const CREDIT_ISSUFISANT = 'Votre solde est insufisant, Merci de le recharger';
		const ACCESS = 'Vous n\'avez pas le droit d\'effectuer cette action';
	// Construct of programme.
		function __construct(array $data_tab){
			$this->hydraty($data_tab);
		}

		// Getter for attributes
		public function getId(){if (isset($this->_id)) {
			return $this->_id;
		} else{
			return false;
		}}
		public function getClientid(){if (isset($this->_clientid)) {
			return $this->_clientid;
		}else{
			return false;
		}}
		public function getSocityname(){if (isset($this->_socityname)) {
			return $this->_socityname;
		}else{
			return false;
		}}
		public function getEmail(){if (isset($this->_email)) {
			return $this->_email;
		}else{
			return false;
		}}
		public function getActivity(){if (isset($this->_activity)) {
			return $this->_activity;
		}else{
			return false;
		}}
		public function getAddress(){if (isset($this->_address)) {
			return $this->_address;
		}else{
			return false;
		}}
		public function getTel(){if (isset($this->_tel)) {
			return $this->_tel;
		}else{
			return false;
		}}
		public function getMobile(){if (isset($this->_mobile)) {
			return $this->_mobile;
		}else{
			return false;
		}}
		public function getCountry(){if (isset($this->_country)) {
			return $this->_country
			;
		}else{
			return false;
		}}
		public function getCity(){if (isset($this->_city)) {
			return $this->_city;
		}else{
			return false;
		}}
		public function getStreet(){if (isset($this->_street)) {
			return$this->_street;
		}else{
			return false;
		}}
		public function getCredit(){if (isset($this->_credit)) {
			return $this->_credit;
		}else{
			return false;
		}}

		// Setter for attributes
		public function setId($id){
			$id = (int) $id; 
			if (isset($id)) {
				$this->_id = $id;
			}else{
				return false;
			}
		}
		public function setClientid($clientid){
			$clientid = (int) $clientid;
			if (isset($clientid) and is_int($clientid)) {
				$this->_clientid = $clientid;
			}
			else{
				return false;
			}
		}
		public function setSocityname($socityname){
			if (isset($socityname) and is_string($socityname)) {
				$this->_socityname = $socityname;
			}else{
				return false;
			}
		}
		public function setEmail($email){
			if (isset($email) and is_string($email)) {
				$this->_email = $email;
			}else{
				return false;
			}
		}
		public function setActivity($activity){
			if (isset($activity)) {
				$this->_activity = $activity;
			}else{
				return false;
			}
		}
		public function setAddress($address){
			if (isset($address)) {
				$this->_address = $address;
			}else{
				return false;
			}
		}
		public function setTel($tel){
			if (isset($tel)) {
				$this->_tel = $tel;
			}else{
				return false;
			}
		}
		public function setMobile($mobile){
			if (isset($mobile)) {
				$this->_mobile = $mobile;
			}else{
				return false;
			}
		}
		public function setCountry($country){
			if (isset($country)) {
				$this->_country = $country;
			}else{
				return false;
			}
		}
		public function setCity($city){
			if (isset($city)) {
				$this->_city = $city;
			}else{
				return false;
			}
		}
		public function setStreet($street){
			if (isset($street)) {
				$this->_street = $street;
			}else{
				return false;
			}
		}
		public function setCredit($credit){
			$credit = (int) $credit;
			if (isset($credit)) {
				$this->_credit = $credit;
			}else{
				return false;
			}
		}
		// Others functions
		public function hydraty(array $donnee)
		{
			foreach($donnee as $key => $value)
			{
				// on recupere le nom du setter correspondant
				$method = 'set'.ucfirst($key);
				// on verifie si la methode existe
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}
		public function acheter($prix){
			$prix = (int) $prix;
			if ($this->_credit < $prix) {
				return self::CREDIT_ISSUFISANT;
			}else{
				$this->_credit - $prix;
				return true;
			}
		}
		// public function commend()
	}
?>
