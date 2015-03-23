<?php
use Ovide\Libs\Mvc\Rest\Controller;
use Ovide\Libs\Mvc\Rest\Exception\NotFound;
use Ovide\Libs\Mvc\Rest\Exception\Conflict;
use Ovide\Libs\Mvc\Rest\Exception\Unauthorized;
use Ovide\Libs\Mvc\Rest\Response;

class Reponses extends GenericController{
	
	public function onConstruct(){
		parent::onConstruct();
		$this->modelClass=Reponse::class;
	}
	
	protected function setObject($model,$obj){
		$model->setLibelle($obj["libelle"]);
	}
	
	public function _toString(){
		return $this->getLibelle();
	}
	
	/*----------MORE---------*/

	public function getQuestion($id){
		$reponse=Reponse::find("question_id=".$id);
		$reponse=$reponse->toArray();
		if(sizeof($reponse)==0)
			throw new NotFound("Aucune réponse trouvé pour la question.");
		return $reponse;
	}
	
}