<?php
class ParentModel {
	//Parent class, programmed OOP way, contains db connexion informations. The following class : UsersModel, PostsModel, CommentsModel will inherit its features and attributes.
	protected $db =null;
	public function __construct(){
		$this->dbConnect();
	}

	protected function dbConnect()
    {
        $db = new \PDO('mysql:host=;dbname=;charset=utf8', '', '');
        $this->db= $db;
    }
}