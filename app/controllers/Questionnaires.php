<?php
use Ovide\Libs\Mvc\Rest\Controller;
use Ovide\Libs\Mvc\Rest\Exception\NotFound;
use Ovide\Libs\Mvc\Rest\Exception\Conflict;
use Ovide\Libs\Mvc\Rest\Exception\Unauthorized;
use Ovide\Libs\Mvc\Rest\Response;
use Phalcon\Forms\Element\Date;

class Questionnaires extends GenericController{
	
	public function onConstruct(){
		parent::onConstruct();
		$this->modelClass=Questionnaire::class;
	}
	
	protected function setObject($model,$obj){
		$model->setLibelle($obj["libelle"]);
		$model->setDomaine(1);
		$model->setUtilisateur(1);
		$model->setDate(date("Y-m-d"));
	}
	
	public function _toString(){
		return $this->getLibelle();
	}
	
}