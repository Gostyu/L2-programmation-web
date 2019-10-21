<?php
function consulterForm(){
 echo'<div class="row center">
    <div class="col">
        <br>
    <!-- <h2>Consulter votre dossier</h2>-->
       <div class="alert alert-info">
           <strong>Saisissez le(s) premier(s) chiffre(s) précedant la lettre A de votre référence</strong>
       </div>
        <form method="post">
             <div class="col-md-3 col-sm-5 mx-auto">
               <div>
                <input type="text" name="reference" size="10" class="form-control" id="inputRef" required placeholder="référence de dossier">
                 <label for="inputRef"></label>	
              	</div>
              </div>
              <div>
               <input type="submit" class="btn btn-primary" name="acceder"value="Accéder au dossier">
              </div>
        </form>
    </div>
</div>';
}
?>