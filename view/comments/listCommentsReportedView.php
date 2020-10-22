<?php $title = 'Sélection d\'un commentaire' ?>
<h2 class="comment-management-title">Tous les commentaires signalés</h2>
<div class="container">
   <div class="table-responsive">
      <table class="table table-hover">
         <thead>
            <tr>
               <th>Nombre de signalement</th>
               <th>Chapitre concerné</th>
               <th>Date de publication du commentaire signalé</th>
               <th>Contenu signalé</th>
               <th>Action</th>
            </tr>
         </thead>
         <?php
            foreach ($reportedComments as $data) {
            ?>
         <tbody>
            <tr>
               <td><?= htmlspecialchars($data['nbTimesReported']) ?></td>
               <td><?= htmlspecialchars($data['titlePost']) ?></td>
               <td><span class="published">Publié le <?= $data['comment_date_fr'] ?></span></td>
               <td><?= nl2br(htmlspecialchars(substr($data['commentContent'], 0, 100))); ?>[...]</td>
               <td><a href="index.php?action=approve-comment&amp;idComment=<?= htmlspecialchars($data['idComment'])?>" class="btn btn-success btn-block" onclick="return(confirm('Confirmez-vous l\'approbation de ce commentaire ?'));">Approuver le commentaire</a>  <a href="index.php?action=delete-reported-comment&amp;idComment=<?= htmlspecialchars($data['idComment']) ?>" class="btn btn-danger btn-block" onclick="return(confirm('Confirmez-vous la suppression de ce commentaire ?'));">Supprimer le commentaire</a><td>
            </tr>
         </tbody>
         <?php
            }
            ?>
      </table>
   </div>
</div>

