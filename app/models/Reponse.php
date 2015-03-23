<?php
use Phalcon\Mvc\Model;

class Reponse extends Model{
	
	protected $id;
	protected $libelle;
	protected $question;
	protected $good;
	
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
	public function getQuestion() {
		return $this->question;
	}
	public function setQuestion($question) {
		$this->question = $question;
		return $this;
	}
	public function getGood() {
		return $this->good;
	}
	public function setGood($good) {
		$this->good = $good;
		return $this;
	}	
}