<?php $title = 'Rédaction d\'un nouveau chapitre'; ?>

<form method="post" action="index.php?action=create-post&amp;idPost=<?= htmlspecialchars('idPost')?>">
   <div class="form-group">
      <label for="title">Titre du chapitre</label>
      <input class="form-control" id="title" placeholder="Titre du chapitre" type="text" name="title">
   </div>

   <div class="form-group">
      <label for="content">Contenu du chapitre</label>
      <textarea class="tinymce" id="content" name="content"></textarea>
   </div>
   <input type="submit" value="Publier" class="btn btn-primary" onclick="return(confirm('Confirmez-vous la suppression de ce chapire ?'));"/>
</form>
