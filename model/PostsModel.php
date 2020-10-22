<?php
require_once('model/ParentModel.php');

class PostsModel extends ParentModel
{	//Model for posts programmed in an OOP way. Class Posts inherits features from Parent Model Object such as getting access to the db.
	//1.0 Posts : CRUD
	//1.1 Create post, back office feature.
	public function createPost($titlePost, $contentPost){
        $req= $this->db->prepare('INSERT INTO posts (titlePost, contentPost, datePost) VALUES (:titlePost, :contentPost, NOW())');
        $req->bindParam(":titlePost", $titlePost, PDO::PARAM_STR);
        $req->bindParam(":contentPost", $contentPost, PDO::PARAM_STR);
        $req->execute();
        $post = $req;
        return $post;
    }
    //1.2 Read posts : front office features.
    //1.2.1 Display on home page last 3 posts, front office feature.
    public function getLatestPosts()
    {
        $req = $this->db->query('SELECT idPost, titlePost, contentPost, DATE_FORMAT(datePost, \'%d/%m/%Y à %H:%i:%s\') AS date_date_fr FROM posts ORDER BY datePost DESC LIMIT 0, 3'); 
        return $req->fetchAll();
    }
    //1.2.2 Display all posts published so far last, front office feature.
    public function getAllPosts()
    {
        $req = $this->db->prepare('SELECT idPost, titlePost, contentPost, DATE_FORMAT(datePost, \'%d/%m/%Y à %H:%i:%s\') AS date_date_fr FROM posts ORDER BY datePost DESC');
        $req->execute();
        return $req->fetchAll();
    }
    //1.2.3 Display one post, front office feature.
    public function getPost($idPost){
        $req = $this->db->prepare('SELECT idPost, titlePost, contentPost, DATE_FORMAT(datePost, \'%d/%m/%Y à %H:%i:%s\') AS date_date_fr FROM posts WHERE idPost = ?');
        $req->execute(array($idPost));
        $post = $req->fetch();
        return $post;
    }
    //1.2.5 Display posts list, back office feature.
    public function getListPosts(){
        $req = $this->db->query('SELECT idPost, titlePost, DATE_FORMAT(datePost, \'%d/%m/%Y à %H:%i:%s\') AS date_date_fr, contentPost FROM posts ORDER BY datePost DESC'); 
        return $req->fetchAll();  
    }
    //1.2.5 Display posts count, back office feature.
     public function getPostsCount(){
        $req = $this->db->prepare("SELECT COUNT(idPost) as postsNb FROM posts");
        $req->execute();
        $postsNb = $req->fetch(); 
        return $postsNb;    
    }
    //1.3 Update post previously published, back office feature.
    public function updatePost($idPost, $titlePost, $contentPost){
        $req= $this->db->prepare('UPDATE posts SET titlePost=:titlePost, contentPost=:contentPost, updatePost=NOW() WHERE idPost=:idPost');
        $req->bindParam(":idPost", $idPost, PDO::PARAM_INT);
        $req->bindParam(":titlePost", $titlePost, PDO::PARAM_STR);
        $req->bindParam(":contentPost", $contentPost, PDO::PARAM_STR);
        $updatePost= $req->execute();
        return  $updatePost;
    }
    //1.4 Delete post previously published, back office feature.
    public function deletePost($idPost){
        $req= $this->db->prepare('DELETE FROM posts WHERE idPost= :idPost');
        $req->bindParam(":idPost", $idPost, PDO::PARAM_INT);
        $req->execute();
        $post = $req;
        return $post;
    }
}


