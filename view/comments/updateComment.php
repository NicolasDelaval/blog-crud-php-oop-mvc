<?php $title = 'Modification d\'un commentaire précédemment publié'; ?>

<form method="post" action="index.php?action=update-comment&amp;idComment=<?= htmlspecialchars($comments['idComment'])?>">
   <div class="form-group">
      <label for="content">Contenu du Commentaire</label>
      <textarea class="tinymce" id="commentContent" name="commentContent"><?= nl2br(htmlspecialchars($updatedComment['commentContent'])) ?></textarea>
   </div>
   <input type="submit" value="Modifier" class="btn btn-primary" />
</form>
