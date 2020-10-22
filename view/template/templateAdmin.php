<!DOCTYPE html>
<html lang="fr">
   <head>
      <title><?= $title ?></title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="./public/bootstrap/css/bootstrap.css" rel="stylesheet">
      <link href="./public/css/adminStyle.css" rel="stylesheet">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <header>
         <div class="jumbotron hidden-xs">
            <h1>Bienvenue sur votre espace de travail Jean Forteroche !</h1>
         </div>
         <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>                        
                  </button>
                  <a class="navbar-brand" href="index.php?action=dashboard">Jean Forteroche</a>
               </div>
               <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav">
                     <li><a href="index.php?action=dashboard"><span class="glyphicon glyphicon-dashboard"></span> Tableau de bord</a></li>
                     <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-book"></span>  Gestion des chapitres<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <li><a href="index.php?action=view-create-post"><span class="glyphicon glyphicon-pencil"></span> Ecrire un nouveau chapitre</a></li>
                           <li><a href="index.php?action=get-list-posts"><span class="glyphicon glyphicon-scissors"></span> Modifier un chapitre publié</a></li>
                           <li><a href="index.php?action=get-list-posts"><span class="glyphicon glyphicon-trash"></span> Supprimer un chapitre publié</a></li>
                        </ul>
                     </li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                     <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>  Gestion des commentaires<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <li><a href="index.php?action=get-list-comments"><span class="glyphicon glyphicon-inbox"></span> Gérer tous les commentaires</a></li>
                           <li><a href="index.php?action=get-list-reported-comments"><span class="glyphicon glyphicon-bell"></span> Gérer les commentaires signalés</a></li>
                        </ul>
                     </li>
                     <li><a href="index.php?action=sign-out"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <div class="container">
         <?= $content ?>
      </div>
      <footer class="page-footer font-small blue fixed-bottom">
         <div class="footer-copyright text-center py-3">© 2019 Copyright:
            <a href="http://bearcreation.fr">Bearcreation.fr</a>
         </div>
      </footer>
      <script src="./public/js/jquery.js"></script>
      <script src="./public/tinymce/tinymce.min.js"></script>
      <script src="./public/tinymce/init-tinymce.js"></script>
      <script src="./public/bootstrap/js/bootstrap.js"></script>
   </body>
</html>