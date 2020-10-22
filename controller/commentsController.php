<?php
//0.0 Required models for comments controller.
require_once 'model/CommentsModel.php';
require_once 'model/PostsModel.php';
require_once 'utils.php';

//1.0 Create comment controller method.
//1.1 Post a new comment by post, front office feature.
function createComment()
{
    $commentsModel = new CommentsModel();
    $idPost = $_GET['idPost'];
    $commentContent = htmlspecialchars($_POST['commentContent']);
    $idUser = $_SESSION['id'];
    $createComment = $commentsModel->createComment($idPost, $commentContent, $idUser);
    redirect(ROOT_URL .'?action=get-post&idPost=' .$idPost);
}
//1.2 Report to admin a previously published comment, front office feature.
function reportComment()
{
	$commentsModel= new CommentsModel;
	$idPost= $_GET['idPost'];
	$idComment= $_GET['idComment'];
	$idUser= $_SESSION['id'];
	$userGot= $commentsModel->getUserById($idComment);
	if($idUser == $userGot['idUser']){
		echo 'Vous avez déjà signalé ce commentaire <br/> <a href="index.php?action=home">Revenir à l\'accueil</a>';
	}else{
		$reportComment= $commentsModel->reportComment($idPost, $idComment, $idUser);
		redirect(ROOT_URL .'?action=get-post&idPost=' .$idPost);
	}
}

//2.0 Read comments controller methods.
//2.1 Display all comments controller method, back office feature.
function getListComments()
{
	$commentsModel = new CommentsModel();
	$allComments= $commentsModel->getAllComments();
	ob_start();
	require 'view/comments/listCommentsView.php';
	$content=ob_get_clean();
	require 'view/template/templateAdmin.php';
}
//2.2 Display all REPORTED comments controller method, back office feature.
function getListReportedComments()
{	$commentsModel= new CommentsModel;
	$reportedComments= $commentsModel->getListReportedComments();
	ob_start();
	require 'view/comments/listCommentsReportedView.php';
	$content=ob_get_clean();
	require 'view/template/templateAdmin.php';
}
//2.3 Display comments count for each post, front office feature.
function displayCommentsCountByPost(){
	$idPost = isset($_GET['idPost']) ? $_GET['idPost'] : null;
	$commentsModel= new CommentsModel;
	$commentsNbByPost= $commentsModel->commentsCountByPost($idPost);	
}

//3.0 Update comments controller methods.
//3.1 Approve reported comment : when approved, the comment is no longer flaged as "reported" into db. Back office feature.
function approveReportedComment()
{
	$commentsModel= new CommentsModel;
	$idComment = isset($_GET['idComment']) ? $_GET['idComment'] : null;
	$approvedComment= $commentsModel->approveReportedComment($idComment);
	redirect(ROOT_URL.'?action=dashboard');
}

//4.0 Delete comments controller methods.
//4.1 Delete comment from comment list
function deleteComment()
{
	$commentsModel = new CommentsModel();
	$deleteComment = $commentsModel->deleteComment($_GET['idComment']);
	$deleteReportedComment= $commentsModel->deleteCommentReported($_GET['idComment']);
	redirect(ROOT_URL.'?action=dashboard');
}
//4.2 Delete comment from comment list and reported list
function deleteCommentReported(){
	$commentsModel= new CommentsModel;
	$deleteComment = $commentsModel->deleteComment($_GET['idComment']);
	$deleteReportedComment= $commentsModel->deleteCommentReported($_GET['idComment']);
	redirect(ROOT_URL.'?action=dashboard');
}