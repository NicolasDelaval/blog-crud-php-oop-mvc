<?php $title = 'Modification d\'un chapitre précédemment publié'; ?>
<form method="post" action="index.php?action=update-post&amp;idPost=<?= htmlspecialchars($post['idPost'])?>">
   <div class="form-group">
      <label for="title">Titre du chapitre</label>
      <input class="form-control" id="titlePost" placeholder="Titre du chapitre" type="text" name="titlePost" value="<?= htmlspecialchars($post['titlePost']) ?>">
      <label for="content">Contenu du chapitre</label>
      <textarea class="tinymce" id="contentPost" name="contentPost"><?= nl2br($post['contentPost']) ?></textarea>
      <br/>
      <input type="submit" value="Modifier" class="btn btn-primary btn-success" onclick="return(confirm('Confirmez-vous la modification de ce chapitre ?'));"/>
   </div>
</form>
