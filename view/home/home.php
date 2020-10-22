<div clas="container-fluid">
   <?php $title = 'Bienvenue sur le blog de Jean Fortoche'; ?>
   <div class="main">
      <h2>Derniers chapitres publiés</h2>
      <?php
         foreach ($posts as $data) {
         ?>
      <div class="news">
         <h2><a href="index.php?action=get-post&amp;idPost=<?= htmlspecialchars($data['idPost']) ?>"><?= htmlspecialchars($data['titlePost']) ?></a></h2>
         <br/>
         <p><span class="published">Publié le <?= $data['date_date_fr'] ?></span> par <span class="author-shaping">Jean Forteroche</span></p>
            <p>
            <?= nl2br(substr($data['contentPost'], 0, 500)) ?>[...]
            <br/>
            <br/>
            <br/>
            <a href="index.php?action=get-post&amp;idPost=<?= htmlspecialchars($data['idPost']) ?>" class="btn btn-primary btn-md">Lire la suite</a>
            <br/>
            <br/>
         </p>
      </div>
      <?php
         }
         ?>
   </div>
</div>