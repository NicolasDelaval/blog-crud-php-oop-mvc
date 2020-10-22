<?php $title = 'Rédaction d\'un nouveau chapitre'; ?>
<div class="writing-zone">
	<form method="post" action="index.php?action=create-post">
	   <div class="form-group">
	      <label for="titlePost" name="titlePost">Titre du chapitre</label>
	      <input class="form-control" id="titlePost" placeholder="Titre du chapitre" type="text" name="titlePost" required value="<?= $titlePost ?>">
	      <br/>
	       <label for="content">Contenu du chapitre</label>
	      <textarea type="text" class="tinymce" id="contentPost" name="contentPost"></textarea>
	      <br/>
	  	  <input type="submit" value="Publier" class="btn btn-primary btn-success" onclick="return(confirm('Confirmez-vous la publication de ce nouveau chapitre ?'));" />
	   </div> 
	</form>
</div>
