<?php
use Ovide\Libs\Mvc\Rest\Controller;
use Ovide\Libs\Mvc\Rest\Exception\NotFound;
use Ovide\Libs\Mvc\Rest\Exception\Conflict;
use Ovide\Libs\Mvc\Rest\Exception\Unauthorized;
use Ovide\Libs\Mvc\Rest\Response;

class Realisations extends GenericController{
	
	public function onConstruct(){
		parent::onConstruct();
		$this->modelClass=Utilisateur::class;
	}
	
	protected function setObject($model,$obj){
		//$model->setLibelle($obj["libelle"]);
		$model->setDate(date("Y-m-d"));
	}
	
	public function _toString(){
		return "utilisateur ".$this->getUtilisateur();
	}	
}