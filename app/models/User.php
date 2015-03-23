<?php
use Phalcon\Mvc\Model;
class User extends Model {
	protected $id;
	protected $mail;
	protected $password;
	protected $salt;
	protected $nom;
	protected $prenom;
	protected $rang;
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getMail() {
		return $this->mail;
	}
	public function setMail($mail) {
		$this->mail = $mail;
		return $this;
	}
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}
	public function getSalt() {
		return $this->salt;
	}
	public function setSalt($salt) {
		$this->salt = $salt;
		return $this;
	}
	public function getNom() {
		return $this->nom;
	}
	public function setNom($nom) {
		$this->nom = $nom;
		return $this;
	}
	public function getPrenom() {
		return $this->prenom;
	}
	public function setPrenom($prenom) {
		$this->prenom = $prenom;
		return $this;
	}
	public function getRang() {
		return $this->rang;
	}
	public function setRang($rang) {
		$this->rang = $rang;
		return $this;
	}
	
	public function beforeCreate(){
		$this->salt = uniqid(mt_rand(), true);
		$this->password=crypt($this->password,$this->salt);
	}
	
	public function getSource(){
		return "utilisateur";
	}
	
}