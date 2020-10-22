<?php
//0.0 Required models for comments controller.
session_start();
require 'model/UsersModel.php';
require_once 'model/CommentsModel.php';
require_once 'model/PostsModel.php';
require_once 'utils.php';

//1.0 Create a new user method controller, front office feature.
function signUp()
{
    $usersModel = new UsersModel;
    $fname= htmlspecialchars($_POST['fname']);
    $lname= htmlspecialchars($_POST['lname']);
    $username= htmlspecialchars($_POST['username']);
    $email= htmlspecialchars($_POST['email']);
    $pwd= htmlspecialchars($_POST['pass']);

    $existingMail = $usersModel->getUser($email);
    $existingUsername= $usersModel->getUsername($username);
    //If an email address or an username is already existing in db, warn user. Else reg new user, front office feature.
    if($existingMail){
        echo 'Cet adresse email est déjà prise ! <br/> Veuillez en choisir une autre <br/> <br/> <a href=index.php?action=home>Revenir sur la page d\'accueil</a> ';

    }else if($existingUsername){
        echo 'Ce nom d\'utilisateur est déjà pris ! <br/> Veuillez en choisir un autre <br/> <br/> <a href=index.php?action=home>Revenir sur la page d\'accueil</a> ';
    }
    else{
        $regUser= $usersModel->signUp($fname, $lname, $username, $email, $pwd);
        redirect(ROOT_URL.'?action=home');
    }
}

//2.0 Read method for user controller. Front office features.
//2.1 Get register form method.
function viewRegister()
{
    require ('view/forms/registerForm.php');
}
//2.2 Get login form method.
function viewLogin()
{
    require ('view/forms/loginForm.php');
}

//3.0 Sign in method for user controller, front office feature.
function signIn()
{
    $usersModel = new UsersModel();
    $email= htmlspecialchars($_POST['email']);
    $pwd= htmlspecialchars($_POST['pass']);
    $user = $usersModel->getUser($email);
    $proper_pass = password_verify($_POST['pass'], $user['pwd']);
    //Check user credentials, if they doesnt match with the ones in db, warn user. Else, start session and write cookies : user is now logged in.
    if(!$user)
    {
        echo 'Identifiants de connexion incorrects ! <br/> Veuillez réessayer  <br/> <br/> <a href=index.php?action=home>Revenir sur la page d\'accueil</a> ';
    }
    else{
        if($proper_pass)
        {   
            $_SESSION['id'] = $user['idUser'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['pwd'] = $user['pwd'];
            $_SESSION['idRole'] = $user['idRole'];
            $id = $user['idUser'];
            $username = $user['username'];
            $pass_hash = $user['pwd'];
            $role = $user['idRole'];
            setcookie('id', $id, time() + 1800, null, null, false, true);
            setcookie('role', $role, time() + 1800, null, null, false, true);
            if($user['idRole'] == 1){
                redirect(ROOT_URL.'?action=dashboard');
            } else{
                redirect(ROOT_URL.'?action=get-all-posts');
            }
        }
    }   
}

//4.0 Sign out method for user controller, front or back office feature.
function signOut()
{
    $_SESSION = array();
    session_destroy();
    setcookie('id', '', time() - 1800, null, null, false, true);
    setcookie('role', '', time() - 1800, null, null, false, true);
    redirect(ROOT_URL.'?action=home');
}

//5.0 Display admin dashboard method, back office feature.
function displayDashboard()
{
    $usersModel = new UsersModel;
    $usersNb= $usersModel-> userCount();
    $commentsModel = new CommentsModel;
    $commentsNb= $commentsModel->commentsCount();
    $reportedNb= $commentsModel->reportedCommentsCount();
    $postsModel= new PostsModel;
    $postsNb= $postsModel->getPostsCount();

    ob_start();
    require 'view/home/homeAdmin.php';
    $content=ob_get_clean();
    require 'view/template/templateAdmin.php';
}


