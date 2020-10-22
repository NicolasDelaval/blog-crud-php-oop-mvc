<?php
require('controller/postsController.php');
require('controller/commentsController.php');
require('controller/usersController.php');
define('ROOT_URL', 'http://localhost/projet_4_php_nicolas_delaval/');

try{
    if(isset($_GET['action'])){
      $action = $_GET['action'];
    }else{
      getLatestPosts();
    }
    if(isset($action)){
        switch ($action){
          case 'home':
            getLatestPosts();
          break;
          case 'view-register' :
            viewRegister();
          break;
          case 'sign-up':
            signUp();
          break;
          case 'view-login' :
            viewLogin();
          break;
          case 'sign-in':
            signIn();
          break;
          case 'sign-out' :
            signOut();
          break;
          case 'get-all-posts' :
            getAllPosts();
          break;
          case 'get-latest-post' :
            getLatestPosts();
          break;
          case 'get-post' :
            if (isset($_GET['idPost']) && $_GET['idPost'] > 0 && is_numeric($_GET['idPost'])){
              getPost();
            }
          break;
          case 'create-comment' :
            if (isset($_GET['idPost']) && $_GET['idPost'] >0 && isset($_SESSION['id']) && ($_SESSION['idRole'] == 2)){
                if (!empty($_POST['commentContent'])){
                  createComment($_GET['idPost'], $_POST['commentContent']);
                }
                else{
                  echo 'Vous ne pouvez envoyer un commentaire vide ! <br/><a href="index.php?action=get-all-posts">Revenir sur la page des chapitres</a>';
                }
            }else{
                echo 'Vous devez vous connecter pour commenter ! <br/><a href="index.php?action=get-all-posts">Revenir sur la page des chapitres</a>';      
            }
          break;
          case 'report-comment' :
            if (isset($_GET['idPost']) && $_GET['idPost'] >0 && isset($_SESSION['id']) && ($_SESSION['idRole'] == 2)){
            reportComment();
          }else{
              echo 'Vous devez vous connecter pour signaler un commentaire ! <br/><a href="index.php?action=get-all-posts">Revenir sur la page des chapitres</a>';
            }
          break;
        }
        if(isset($action) && isset($_SESSION['id']) && ($_SESSION['idRole'] == 1)){
          switch ($action){
          case 'dashboard':
            displayDashboard();
          break;
          case 'get-list-posts':
            getListPosts();
          break;
          case 'view-create-post' :
          	viewCreatePost();
          break;
          case 'create-post' :
            createPost();
          break;
          case 'get-post-admin':
            getPostAdmin();
          break;
          case 'view-update':
            viewUpdate();
          break;
           case 'view-comment-update':
            viewCommentUpdate();
          break;
          case 'update-post' :
            updatePost();
          break;
          case 'delete-post' :
            deletePost();
          break;
          case 'get-list-comments':
          	getListComments();
          break;
          case 'get-list-reported-comments' :
            getListReportedComments();
          break;
          case 'approve-comment':
            approveReportedComment();
          break;
          case 'delete-comment':
            deleteComment();
          break;
          case 'delete-reported-comment':
            deleteCommentReported();
          break;
        }
      }
    }
}catch(Exception $e){
	
}
