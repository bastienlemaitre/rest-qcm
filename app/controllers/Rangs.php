<?php
use Ovide\Libs\Mvc\Rest\Controller;
use Ovide\Libs\Mvc\Rest\Exception\NotFound;
use Ovide\Libs\Mvc\Rest\Exception\Conflict;
use Ovide\Libs\Mvc\Rest\Exception\Unauthorized;
use Ovide\Libs\Mvc\Rest\Response;

class Rangs extends GenericController{
	
	public function onConstruct(){
		parent::onConstruct();
		$this->modelClass=Rang::class;
	}
	
	protected function setObject($model,$obj){
		$model->setLibelle($obj["libelle"]);
	}
	
	public function _toString(){
		return $this->getLibelle();
	}
	
}