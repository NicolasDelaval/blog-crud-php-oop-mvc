<?php
require_once('model/ParentModel.php');

class CommentsModel extends ParentModel
{   
    //Model for comments programmed in an OOP way. Class Comments inherits features from Parent Model Object such as getting access to the db.
    //1.0 Comments : CRD
    //1.1 Create comment, front office feature.
    public function createComment($idPost, $commentContent, $idUser)
    {
    	$req = $this->db->prepare('INSERT INTO comments (idPost, commentContent, dateComment, idUser) VALUES(:idPost, :commentContent, NOW(), :idUser)');
        $req->bindParam(":idPost", $idPost, PDO::PARAM_INT);
        $req->bindParam(":commentContent", $commentContent, PDO::PARAM_STR);
        $req->bindParam(":idUser", $idUser, PDO::PARAM_STR);
        $req->execute();
        $createComment = $req;
        return $createComment;
    }
    //1.2 Read Comments
    //1.2.1 Display comment by chapter : use of inner join between User and Reported tables to get all informations needed, front office feature.
    public function getCommentsByPost($idPost)
    {
        $req = $this->db->prepare('SELECT comments.idComment AS idComment, DATE_FORMAT(comments.dateComment, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr, comments.commentContent, user.username AS username, comments.idUser AS idUser
                                   FROM user
                                   INNER JOIN comments ON comments.idUser = user.idUser
                                   WHERE comments.idPost=:idPost
                                   ORDER BY comments.dateComment DESC');
        $req->bindParam(":idPost", $idPost, PDO::PARAM_INT);
        $req->execute();
        $comments= $req->fetchAll();
        return $comments;
    }
    //1.2.2 Read All Comments for admin back office: use of inner join between User and Reported tables to get all informations needed, back office feature.
    public function getAllComments()
    {
        $allComments = $this->db->query('SELECT comments.idComment AS idComment, comments.commentContent AS commentContent, DATE_FORMAT(comments.dateComment, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr, user.username AS username, posts.titlePost AS titlePost
                                         FROM user
                                         INNER JOIN comments ON comments.idUser = user.idUser
                                         INNER JOIN posts ON comments.idPost=posts.idPost
                                         ORDER BY comments.dateComment DESC');
        $allComments->execute();
        return $allComments->fetchAll();
    }
    //1.2.3 Total comments count, back office feature.
    public function commentsCount()
    {
        $req = $this->db->prepare('SELECT COUNT(idComment) AS commentsNb FROM comments');
        $req->execute();
        $commentsNb = $req->fetch();   
        return $commentsNb;
    }
    //1.2.4 Comments count by chapter, front office feature.
    public function commentsCountByPost($idPost)
    {
        $req = $this->db->prepare('SELECT COUNT(idComment) AS commentsNb FROM comments GROUP BY idPost');
        $req->execute();
        $commentsNbByPost = $req->fetch();   
        return $commentsNbByPost;
    }
    //1.3 Delete comments
    //1.3.1 Delete one specific comments, back office feature.
    public function deleteComment($idComment){
        $req= $this->db->prepare('DELETE FROM comments WHERE idComment= :idComment');
        $req->bindParam(":idComment", $idComment, PDO::PARAM_INT);
        $req->execute();
        $deleteComment = $req;
        return $deleteComment;
    }
    //1.3.2 Delete all comments related to a chapter when deleting it, back office feature.
    public function deleteAllComments($idPost){
        $req= $this->db->prepare('DELETE FROM comments WHERE idPost= :idPost');
        $req->bindParam(":idPost", $idPost, PDO::PARAM_INT);
        $req->execute();
        $deleteAllComments = $req;
        return $deleteAllComment;
    }
    //2.0 CRUD : Reported Comments
    //2.1 Create a report for a specific comment, front office feature.
    public function reportComment($idPost, $idComment, $idUser){
        $reportComment= $this->db->prepare('INSERT INTO reported (idPost, idComment, idUser) VALUES(:idPost, :idComment, :idUser)');
        $reportComment->bindParam(":idPost", $idPost, PDO::PARAM_INT);
        $reportComment->bindParam(":idComment", $idComment, PDO::PARAM_INT);
        $reportComment->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $reportComment->execute();
        return $reportComment;
    }
    //2.2 Read reported comments
    //2.2.1 Display all reported comments, use inner join beetween tables Posts and Comments to get all info needed, back office feature.
    public function getListReportedComments()
    {
        $reportedComments = $this->db->prepare('SELECT  reported.idComment, count(*) AS nbTimesReported, reported.idPost AS idPost, posts.titlePost AS titlePost, comments.idComment AS idComment, comments.commentContent AS commentContent, DATE_FORMAT(comments.dateComment, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr
                                                FROM reported                                              
                                                INNER JOIN posts ON reported.idPost = posts.idPost                                                                                 
                                                INNER JOIN comments ON reported.idComment = comments.idComment
                                                WHERE reported.approved = 0
                                                GROUP BY reported.idComment                                                
                                                ORDER BY nbTimesReported DESC');
        $reportedComments->execute();
        return $reportedComments;
    }
    //2.2.2 Display count of reported comments, use 'Distinct' to build sql query to avoid reduncy data, back office feature.
    public function reportedCommentsCount()
    {
        $req = $this->db->prepare('SELECT COUNT(DISTINCT idComment) AS reportedNb FROM reported WHERE approved = 0');
        $req->execute();
        $reportedNb = $req->fetch();
        return $reportedNb;
    }
    //2.3 Update comments : approve reported comments so they are no longer considered as "reported", back office feature.
    public function approveReportedComment($idComment)
    {
        $req = $this->db->prepare('UPDATE reported SET approved=1 WHERE idComment=:idComment');
        $req->bindParam(':idComment', $idComment, PDO::PARAM_INT);
        $req->execute();
        $approvedComment= $req;
        return $approvedComment;
    }
    //2.4 Delete Reported Comment, delete a reported comment so it's no longer displayed in front office.
    public function deleteCommentReported($idComment){
        $req= $this->db->prepare('DELETE FROM reported WHERE idComment= :idComment');
        $req->bindParam(":idComment", $idComment, PDO::PARAM_INT);
        $req->execute();
        $deleteReportedComment = $req;
        return $deleteReportedComment;
    }
    //2.5 Delate all reported comments by Post
      public function deleteAllReportedComments($idPost){
        $req= $this->db->prepare('DELETE FROM reported WHERE idPost= :idPost');
        $req->bindParam(":idPost", $idPost, PDO::PARAM_INT);
        $req->execute();
        $deleteAllReportedComments = $req;
        return $deleteAllReportedComments;
    }
    //3.0 Get IdUser from Reported table by idComment
    public function getUserById($idComment)
    {
        $getUser = $this->db->prepare('SELECT idUser AS idUser FROM reported WHERE idComment=:idComment');
        $getUser->bindParam(":idComment", $idComment, PDO::PARAM_STR);
        $getUser->execute();
        $userGot = $getUser->fetch();
        return $userGot;
    }
}

 