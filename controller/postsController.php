<?php
//0.0 Required models for comments controller.
require 'model/PostsModel.php';
require_once 'model/CommentsModel.php';
require 'utils.php';

//1.0 Create post controller method, back office feature.
function createPost()
{
	$postModel = new PostsModel();
	$titlePost = isset($_POST['titlePost']) ? $_POST['titlePost'] : NULL;
	$contentPost = isset($_POST['contentPost']) ? $_POST['contentPost'] : NULL;
	$post = $postModel->createPost($titlePost, $contentPost);
	redirect(ROOT_URL.'?action=dashboard');
}

//2.0 Read posts controller methods.
//2.1 Display 3 last posts controller method, front office feature.
function getLatestPosts()
{	
	$postModel = new PostsModel();
	$posts= $postModel->getLatestPosts();
	$commentsModel = new CommentsModel;
	$idPost= isset($_GET['idPost']) ? $_GET['idPost'] : null;
	$commentsCountByPost= $commentsModel->commentsCountByPost($idPost);
	ob_start();
	require 'view/home/home.php';
	$content=ob_get_clean();
	require 'view/template/template.php';
}
//2.2 Display every posts controller method, front office feature.
function getAllPosts() 
{
	$postModel = new PostsModel();
	$posts= $postModel->getAllPosts();
	ob_start();
	require 'view/posts/allPostsView.php';
	$content=ob_get_clean();
	require 'view/template/template.php';
}
//2.3 Display a post and its comments controller method, front office feature.
function getPost()
{
	$idPost = ($_GET['idPost']);
	$postModel = new PostsModel();
	$commentsModel = new CommentsModel();
	$post= $postModel->getPost($idPost);
	$comments = $commentsModel->getCommentsByPost($idPost);
	ob_start();
	require 'view/posts/postView.php';
	$content=ob_get_clean();
	require 'view/template/template.php';
}
//2.4 Get posts list in order to update or delete them, back office feature.
function getListPosts()
{
	$postModel = new PostsModel();
	$posts= $postModel->getListPosts();
	ob_start();
	require 'view/posts/getListPosts.php';
	$content=ob_get_clean();
	require 'view/template/templateAdmin.php';
}
//2.5 Get view post in order to update or delete them, back office feature.
function viewCreatePost()
{
	$postModel = new PostsModel();
	$titlePost = isset($_POST['titlePost']) ? $_POST['titlePost'] : NULL;
	$contentPost = isset($_POST['contentPost']) ? $_POST['contentPost'] : NULL;
	$post = $postModel->createPost($titlePost, $contentPost);
	ob_start();
	require 'view/posts/postCreate.php';
	$content=ob_get_clean();
	require 'view/template/templateAdmin.php';
}

function viewUpdate()
{
	$postModel = new PostsModel();
	$idPost=isset($_GET['idPost']) ? $_GET['idPost'] : null;
	$post= $postModel->getPost($_GET['idPost']);
	ob_start();
	require 'view/posts/updatePost.php';
	$content=ob_get_clean();
	require 'view/template/templateAdmin.php';
}

//3.0 Update post controller method, back office feature.
function updatePost()
{
	$postModel = new PostsModel();
	$idPost=$_GET['idPost'];
	$post= $postModel->getPost($_GET['idPost']);
	$titlePost = isset($_POST['titlePost']) ? $_POST['titlePost'] : NULL;
	$contentPost = isset($_POST['contentPost']) ? $_POST['contentPost'] : NULL;
	$updatePost= $postModel->updatePost($idPost, $titlePost, $contentPost);
	redirect(ROOT_URL.'?action=dashboard');
}

//4.0 Delete post controller method, back office feature.
function deletePost()
{
	$postModel = new PostsModel();
	$posts= $postModel->deletePost($_GET['idPost']);
	$commentsModel = new CommentsModel;
	$deleteComments = $commentsModel->deleteAllComments($_GET['idPost']);
	$deleteAllReportedComments= $commentsModel->deleteAllReportedComments($_GET['idPost']);
	redirect(ROOT_URL.'?action=get-list-posts');
}