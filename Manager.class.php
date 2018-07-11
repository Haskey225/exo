<?php
	class Manager
	{
		private $_db;
		const EMAIL_ERROR = 'Ce mail est déjà utilisé';
		const RECHARGE_MSG = 'Le crédit à bien ete acheter';
		const DELETE_MSG = 'Cet utilisateur a été supprimé avec succès';
		public function __construct(PDO $db)
		{
			if (isset($db)) {
				$this->_db = $db;
			}
		}

		public function getListe(){
			$data = array();
			$q=$this->_db->query('SELECT * FROM clients');
			if ($q) {
				$data = $q->fetch();
				return $data;
			}else{return false;}
			
		}

		public function getClentbymail($email)
		{
			$q = $this->_db->prepare('SELECT * FROM clients WHERE email=:email');
			$q->execute(array(
				'email'=>$email));
			$data = $q->fetch();
			return $data;
		}
		public function addClient(Client $client){if (isset($client)) {
			$q = $this->_db->prepare('INSERT INTO clients(clientid, socityname, email, activity, address, tel, mobile, country, city) VALUES(:clientid, :socityname, :email, :activity, :address, :tel,:mobile, :country, :city)');
			$q->execute(array(
				'clientid'=>$client->getClientid(),
				'socityname'=>$client->getSocityname(),
				'email'=>$client->getEmail(),
				'activity'=>$client->getActivity(),
				'address'=>$client->getAddress(),
				'tel'=>$client->getTel(),
				'mobile'=>$client->getMobile(),
				'country'=>$client->getCountry(),
				'city'=>$client->getCity()));
			unset($q);
			$q = $this->_db->prepare('INSERT INTO credits(clientid, argent) VALUES(:clientid, :argent)');
			$q->execute(array(
				'clientid'=>$client->getClientid(),
				'argent'=>0));
			return true;
			}
			else{
				return false;
			}
		}
		public function getLastid(){
			$q= $this->_db->query('SELECT id FROM lastid');
			if ($q) {
				$lastid = $q->fetch();
				$update = $lastid['id'] + 1;
				$q=$this->_db->prepare('UPDATE lastid SET id=:id');
				$q->execute(array(
					'id'=>$update));
				return $lastid;
			}else{
				return false;
			}
		}
		public function existEmail($email){
			$retour = true;
			$q=$this->_db->query('SELECT email FROM clients');
			while ($emails = $q->fetch()) {
				if ($emails['email'] == $email) {
					$retour = false;
				}
			}
			return $retour;
		}
		public function deleteClients($clientid){
			$q = $this->_db->prepare('DELETE * FROM clients WHERE clientid = :clientid');
			$q->exec(array(
				'clientid'=>$clientid));
		}

		public function recharge(Client $client, $credit){
			$credit = (int) $credit;
			if (isset($client) AND isset($credit)) {
				$q = $this->_db->prepare('UPDATE credits SET clientid=:clientid, argent=:argent');
				$q->execute(array(
				'clientid'=>$client->getClientid(),
				'argent'=>$credit));
			}
			echo $client->getClientid();
		}
	}
?>
