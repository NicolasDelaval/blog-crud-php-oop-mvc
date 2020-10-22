<?php $title = 'S\'enregistrer'; ?>

 
        <div class="modal-header" style="padding:35px 50px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4><span class="glyphicon glyphicon-edit"></span> S'enregistrer</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
            <form action="index.php?action=sign-up" method="POST">
                <div class="form-group">
                    <label for="fname">Prénom</label>
                    <input class="form-control" id="fname" placeholder="Prénom" type="text" name="fname" required>
                </div>
                <div class="form-group">
                    <label for="lname">Nom</label>
                    <input class="form-control" id="lname" placeholder="Nom" type="text" name="lname"  required>
                </div>
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input class="form-control" id="username" placeholder="username" type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" type="text" name="email" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Mot de passe</label>
                    <input class="form-control" id="pwd" placeholder="Mot de passe" type="password" name="pass" required>
                </div>
                <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Créer mon compte</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
        </div>












