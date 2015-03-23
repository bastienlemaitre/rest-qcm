<?php
use Phalcon\Mvc\Model;

class Realisation extends Model{
	protected $id;
	protected $utilisateur;
	protected $questionnaire;
	protected $score;
	protected $date;
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getUtilisateur() {
		return $this->utilisateur;
	}
	public function setUtilisateur($utilisateur) {
		$this->utilisateur = $utilisateur;
		return $this;
	}
	public function getQuestionnaire() {
		return $this->questionnaire;
	}
	public function setQuestionnaire($questionnaire) {
		$this->questionnaire = $questionnaire;
		return $this;
	}
	public function getScore() {
		return $this->score;
	}
	public function setScore($score) {
		$this->score = $score;
		return $this;
	}
	public function getDate() {
		return $this->date;
	}
	public function setDate($date) {
		$this->date = $date;
		return $this;
	}
}