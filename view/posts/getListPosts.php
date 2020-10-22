<?php $title = 'Sélection d\'un chapitre' ?>
<h1>Tous les chapitres publiés</h1>
<div class="container">
	<div class="table-responsive">
	    <table class="table table-hover">
	        <thead>
	            <tr>
	                <th>Titre du chapitre</th>
	                <th>Date de publication</th>
	                <th>Contenu</th>
	                <th>Action</th>
	            </tr>
	        </thead>
	        <?php
	            foreach ($posts as $data) {
	            ?>
	        <tbody>
	            <tr>
	                <td><?= $data['titlePost'] ?></td>
	                <td><span class="published">Publié le <?= $data['date_date_fr'] ?></span></td>
	                <td><?= nl2br((substr($data['contentPost'], 0, 100))); ?>[...]</td>
	                <td><a href="index.php?action=view-update&amp;idPost=<?= htmlspecialchars($data['idPost'])?>" class="btn btn-success btn-block">Modifier</a>  <a href="index.php?action=delete-post&amp;idPost=<?= htmlspecialchars($data['idPost']) ?>" class="btn btn-danger btn-block">Supprimer</a><td>
	                <td></td>
	            </tr>
	        </tbody>
	        <?php
	            }
	            ?>
	    </table>
	</div>
</div>




