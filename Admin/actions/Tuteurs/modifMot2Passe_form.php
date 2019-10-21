<?php
function afficheModifMDPForm(){
    echo'
    <div>
    <form method="post">
        <h2>Changement de mot passe</h2>
        <div class="row">
          <div class="col-md-4">
            <input type="password" name="nouveauMDP" class="form-control" id="inputLogin" required placeholder="Nouveau mot de passe">
             <label for="inputNom"></label>	
            </div>
            <div class="col-md-4">
              <button type="submit" name="valider" class="btn btn-primary">Valider</button>
             </div>
        </div>
</form>
</div>
';
   }
?>