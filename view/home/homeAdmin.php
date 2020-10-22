<?php $title = 'Espace Administrateur'; ?>
<h2>Vue d'ensemble</h2>
<div class="row">
   <div class="col-sm-3">
      <div class="well">
         <h4>Chapitres publiés</h4>
         <p class="countInfo"><?= $postsNb['postsNb']?></p>
      </div>
   </div>
   <div class="col-sm-3">
      <div class="well">
         <h4>Commentaires publiés</h4>
         <p class="countInfo"><?= $commentsNb['commentsNb']?></p>
      </div>
   </div>
   <div class="col-sm-3">
      <div class="well">
         <h4>Lecteurs enregistrés</h4>
         <p class="countInfo"><?= $usersNb['usersNb']?></p>
      </div>
   </div>
   <div class="col-sm-3">
      <div class="well">
         <h4>Commentaires signalés</h4>
         <p class="countInfo"><?= $reportedNb['reportedNb']?></p>
      </div>
   </div>
</div>
