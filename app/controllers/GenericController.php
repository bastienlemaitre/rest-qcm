<?php
use Ovide\Libs\Mvc\Rest\Controller;
use Ovide\Libs\Mvc\Rest\Exception\NotFound;
use Ovide\Libs\Mvc\Rest\Exception\Conflict;
use Ovide\Libs\Mvc\Rest\Exception\Unauthorized;
use Ovide\Libs\Mvc\Rest\Response;

class GenericController extends Controller{
	
	protected $modelClass;
	
	public function onConstruct() {
		parent::onConstruct();
		/*
		header ("Access-Control-Allow-Origin:*", true);
		header ("Access-Control-Allow-Methods: GET,OPTIONS", true);
		header ("Access-Control-Allow-Headers: x-requested-with", true);
		*/
	}
	
	public function get(){
		$model=$this->modelClass;
		$obj=$model::find();
		$obj=$obj->toArray();
		if(sizeof($obj)==0){
			throw new NotFound("Aucun {$this->modelClass} trouvé.");
		}
		return $obj;
	}
	
	public function getOne($id){
		$model=$this->modelClass;
		if(!$obj=$model::findFirst($id)){
			throw new NotFound("Ooops ! {$this->modelClass} {$this->modelClass->getId()} est introuvable.");
		}
		return $obj->toArray();
	}
	
	public function post($object){
		$model=$this->modelClass;
        if($this->_isValidToken($this->request->get("token"),$this->request->get("force"))){
	        $obj = new $model;
	        if($obj->create($object)==false){
	        	throw new Conflict("Impossible d'ajouter '{$object}' dans la base de données.");
	        }else{
				return array("data"=>$obj->toArray(),"message"=>$this->successMessage("'{$obj->getLibelle()}' a été correctement ajoutée dans les {$this->modelClass}s."));
	        }
        }else{
        	return array("message"=>"Vous n'avez pas les droits pour ajouter un {$this->modelClass}.");
        }
    }
    
    public function put($id, $object){
    	$model=$this->modelClass;
    	if($this->_isValidToken($this->request->get("token"),$this->request->get("force"))){
    		$obj = $model::findFirst($id);
    		if(!$obj){
    			throw new NotFound("Mise à jour : {$this->modelClass} {$object} n'existe plus dans la base de données.");
    			return array();
    		}else{
    			$this->setObject($obj,$object);
    			try{
    				$obj->save();
    				return array("data"=>$object,"message"=>$this->successMessage("'{$object}' a été correctement modifiée."));
    			}
    			catch(Exception $e){
    				throw new Conflict("Impossible de modifier '{$object}' dans la base de données.<br>".$e->getMessage());
    			}
    		}
    	}else{
    		throw new Unauthorized("Vous n'avez pas les droits pour modifier un {$this->modelClass}.");
    	}
    }
    
    public function delete($id){
    	$model=$this->modelClass;
    	if($this->_isValidToken($this->request->get("token"),$this->request->get("force"))){
    		$obj = $model::findFirst($id);
    		if(!$obj){
    			return array("message"=>$this->warningMessage("Mise à jour : La {$this->modelClass} d'id '".$id."' n'existe plus dans la base de données."),"code"=>Response::UNAVAILABLE);
    		}else{
    			try{
    				$obj->delete();
    				return array("data"=>$obj->toArray(),"message"=>$this->successMessage("'{$obj}' a été correctement supprimée de l'ensemble des {$this->getModelName()}s."));
    			}
    			catch(Exception $e){
    				throw new Conflict("Impossible de supprimer '{$obj}' dans la base de données.<br>".$e->getMessage());
    			}
    		}
    	}else{
    		throw new Unauthorized("Vous n'avez pas les droits pour supprimer un {$this->getModelName()}.");
    	}
    }
    
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
	}
}