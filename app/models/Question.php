<?php
use Phalcon\Mvc\Model;

class Question extends Model{
	protected $id;
	protected $libelle;
	protected $questionnaire;
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getLibelle() {
		return $this->libelle;
	}
	public function setLibelle($libelle) {
		$this->libelle = $libelle;
		return $this;
	}
	public function getQuestionnaire() {
		return $this->questionnaire;
	}
	public function setQuestionnaire($questionnaire) {
		$this->questionnaire = $questionnaire;
		return $this;
	}		
}