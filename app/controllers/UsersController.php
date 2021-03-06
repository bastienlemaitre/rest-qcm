<?php
use Phalcon\Mvc\Controller;
class UsersController extends Controller {
	private $token;
	private function _auth($mail,$password){
		$result=false;
		$user=User::findFirst(array(
			"conditions" => "mail = ?1",
			"bind"       => array(1 => $mail)
		));
		if($user){
			if (hash_equals($user->getPassword(), crypt($password, $user->getSalt()))) {
				$this->token=bin2hex(openssl_random_pseudo_bytes(16));
				$this->session->set("token",$this->token);
				$result=true;
			}
		}
		return $result;
	}

	public function userFormAction(){
	}

	public function userAddAction(){
		$this->response->setContentType('application/json', 'utf-8');
		$user=new User();
		$user->setMail($this->request->getPost("mail"));
		$user->setPassword($this->request->getPost("password"));
		$user->setNom($this->request->getPost("nom"));
		$user->setPrenom($this->request->getPost("prenom"));
		$user->setRang(2);
		if($user->save()){
			$token=bin2hex(openssl_random_pseudo_bytes(16));
			$this->persistent->token = $token;
			echo '{"token":"'.$token.'","inserted":true}';
		}else{
			echo '{"inserted":false}';
		}
	}
	public function checkUserExistsAction($mail){
		$this->response->setContentType('application/json', 'utf-8');
		$user=User::findFirst(array(
				"conditions" => "mail = ?1",
				"bind"       => array(1 => $mail)
		));
		if($user){
			echo '{"exists":true,"mail":"'.$mail.'"}';
		}else{
			echo '{"exists":false,"mail":"'.$mail.'"}';
		}
	}
	public function checkConnectionAction($mail,$password){
		$this->response->setContentType('application/json', 'utf-8');
		if($this->_auth($mail, $password)){
			echo '{"token":"'.$this->token.'","connected":true}';
		}else{
			echo '{"connected":false}';
		}
	}

	public function checkConnectedAction(){
		$this->response->setContentType('application/json', 'utf-8');
		if($this->session->has("token")){
			echo '{"token":"'.$this->session->get("token").'","connected":true}';
		}else{
			echo '{"connected":false}';
		}
	}

	public function connectAction(){
		$mail=$this->request->getPost("mail");
		$password=$this->request->getPost("password");
		if($this->_auth($mail, $password)){
			echo '{"token":"'.$this->token.'","connected":true}';
		}else{
			echo '{"connected":false}';
		}
	}

	public function disconnectAction(){
		$this->response->setContentType('application/json', 'utf-8');
		$this->session->destroy();
		echo '{"connected":false}';
	}
	
	/*
	protected function _isValidToken($token,$force=false){
		return $force=="true" || $this->session->get("token")===$token;
	}
	
	protected function sendMessage($type,$content){
		return array("type"=>$type,"content"=>$content);
	}
	
	protected function infoMessage($message){
		return $this->sendMessage("info",$message);
	}
	
	protected function successMessage($message){
		return $this->sendMessage("success",$message);
	}
	
	protected function warningMessage($message){
		return $this->sendMessage("warning",$message);
	}
	
	protected function dangerMessage($message){
		return $this->sendMessage("danger",$message);
	}*/
}