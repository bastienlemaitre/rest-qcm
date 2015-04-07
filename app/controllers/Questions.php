<?php
use Ovide\Libs\Mvc\Rest\Controller;
use Ovide\Libs\Mvc\Rest\Exception\NotFound;
use Ovide\Libs\Mvc\Rest\Exception\Conflict;
use Ovide\Libs\Mvc\Rest\Exception\Unauthorized;
use Ovide\Libs\Mvc\Rest\Response;

class Questions extends GenericController{
	
	public function onConstruct(){
		parent::onConstruct();
		$this->modelClass=Question::class;
	}
	
	protected function setObject($model,$obj){
		$model->setLibelle($obj["libelle"]);
		$model->setQuestionnaire(1);
	}
	
	public function _toString(){
		return $this->getLibelle();
	}
	
	/*----------MORE---------*/

	public function getQuestionnaire($id){
		$question=Question::find("questionnaire=".$id);
		$question=$question->toArray();
		if(sizeof($question)==0)
			throw new NotFound("Aucune question trouvée pour le questionnaire.");
		return $question;
	}
	
	public function getReponse($posted){
		var_dump($posted);
		//$reponse_choisie=Reponse::find("question=".$id);
		//$reponse_exacte=Reponse::find("question=".$id." AND good=1");
		//return $reponse_choisie->toArray();
	}
}