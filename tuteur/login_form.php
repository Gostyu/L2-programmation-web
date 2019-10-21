<?php
//require("auth/EtreAuthentifie.php");
$title="Authentification";
include("includes/header.php");

echo "<p class=\"error\">".($error??"")."</p>";
?>
    <div class="container center">
        <h2>Authentifiez-vous à l'espace Tuteur</h2>
        <div class="row">
            <div class="col">
              <form method="post">
                   <div class="form-group col-md-3 mx-auto ">
                        <input type="text" name="login" size="10" class="form-control" id="inputLogin" required placeholder="Login"
                                   required value="<?= $data['login']??"" ?>">
                         <label for="inputNom"></label>	
                  	</div>
                    <div class="form-group col-md-3 mx-auto">
                       <input type="password" name="password" size="20" class="form-control" required id="inputMDP"
                      placeholder="Mot de passe">
                      <label for="inputMDP"></label>	
                   </div>
                  <div class="form-group">
                       <button type="submit" class="btn btn-primary ">Connexion</button>
                  </div>
            </form>
            </div>
        </div>
    </div>
<?php

include("includes/footer.php");