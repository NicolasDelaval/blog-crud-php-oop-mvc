<?php
require_once('model/ParentModel.php');

class UsersModel extends ParentModel
{
    //Model for users programmed in an OOP way. Class Users inherits features from Parent Model Object such as getting access to the db.
    //1.0 Create a new user in to database method.
 	Public function signUp($fname, $lname, $username, $email, $pwd)
 	{
 		$pwd_string= $_POST['pass'];
 		$pwd_hash = password_hash($pwd_string, PASSWORD_DEFAULT); //For security purpose, hash password set by user.
        $regUser = $this->db->prepare('INSERT INTO user (fname, lname, username, email, pwd, idRole) VALUES (:fname, :lname, :username, :email, :pwd, 2)');
 		$regUser->bindParam(":fname", $fname, PDO::PARAM_STR);
        $regUser->bindParam(":lname", $lname, PDO::PARAM_STR);
        $regUser->bindParam(":username", $username, PDO::PARAM_STR);
        $regUser->bindParam(":email", $email, PDO::PARAM_STR);
        $regUser->bindParam(":pwd", $pwd_hash, PDO::PARAM_STR);
        $regUser->execute();
        return $regUser;
 	}
    //2.0 Getters methods
    //2.1 Retrieving an user from its email : used for register checking and sign in.
 	public function getUser($email)
    {
        $getUser = $this->db->prepare('SELECT * FROM user WHERE email=:email');
        $getUser->bindParam(":email", $email, PDO::PARAM_STR);
        $getUser->execute();
        $user = $getUser->fetch();
        return $user;
    }
    //2.2 Retrieving an user from its username : used for register checking and sign in.
    public function getUsername($username)
    {
        $getUsername = $this->db->prepare('SELECT * FROM user WHERE username=:username');
        $getUsername->bindParam(":username", $username, PDO::PARAM_STR);
        $getUsername->execute();
        $username = $getUsername->fetch();
        return $username;
    }
    //2.3 Sum of registered users : this info will be displayed in back office dashboard.
    public function userCount()
    {
        $req = $this->db->prepare('SELECT COUNT(idUser) AS usersNb FROM user WHERE idRole=2');
        $req->execute();
        $usersNb = $req->fetch();   
        return $usersNb;
    }  
}

		