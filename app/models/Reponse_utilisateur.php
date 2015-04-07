<?php
use Phalcon\Mvc\Model;

class Reponse_utilisateur extends Model{
	protected $reponse;
	protected $realisation;
	public function getReponse() {
		return $this->reponse;
	}
	public function setReponse($reponse) {
		$this->reponse = $reponse;
		return $this;
	}
	public function getRealisation() {
		return $this->realisation;
	}
	public function setRealisation($realisation) {
		$this->realisation = $realisation;
		return $this;
	}	
}