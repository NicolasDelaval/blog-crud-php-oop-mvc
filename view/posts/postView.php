<?php $title = 'Billet simple pour l\'Alaska -' . htmlspecialchars($post['titlePost']); ?>
<div class="news">
   <h2><?= ($post['titlePost']) ?></h2>
   <br/>
   <p><span class="published">Publié le <?= $post['date_date_fr'] ?></span> par <span class="author-shaping">Jean Forteroche</span></p>
   <br/>
   <p>
      <?= nl2br($post['contentPost']) ?>
   </p>
</div>
<br/>
<br/>
<h2>Commentaires</h2>
<?php if(empty($comments)) {?>
<p class="no-comments-yet">Pas de commentaires pour le moment, soyez le premier à réagir !</p>
<?php } else { ?>            
<?php }?>
<?php
   foreach ($comments as $data){
   ?>
<div class="media">
   <div class="media-left">
      <img src="./public/img/avatar.png" class="media-object" alt="avatar picture" style="width:60px">
   </div>
   <div class="media-body">
      <h3 class="media-heading"><?= htmlspecialchars($data['username']) ?></h3>
      <p>
         <?= nl2br(htmlspecialchars($data['commentContent']))?>
         <br />
         <br />
      <p><span class="published">Publié le <?= htmlspecialchars($data['comment_date_fr']) ?></span></p>
      <br />
      <a href="index.php?action=report-comment&amp;idPost=<?= htmlspecialchars($idPost) ?>&amp;idComment=<?= htmlspecialchars($data['idComment'])?>&amp;idUser=<?= htmlspecialchars($data['idUser']) ?>" method='post' class="btn btn-primary">Signaler ce commentaire</a>
      <br />
      <br />
      </p>
   </div>
</div>
<?php
   }
   ?>
<br/>
<div class="comments-section">
   <h2>Réagissez !</h2>
   <form role="form" action="index.php?action=create-comment&amp;idPost=<?= htmlspecialchars($idPost) ?>" method="post">
      <small id="#" class="form-text text-muted">Vous devez être connecté pour commenter un article</small>
      <div class="form-group">
         <textarea class="form-control comment-form" rows="3" name="commentContent" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-success">Envoyez votre commentaire</button>
   </form>
   <br />
   <p><a href="index.php?action=get-all-posts" class="btn btn-primary">Retournez à la liste des chapitres</a></p>
</div>

