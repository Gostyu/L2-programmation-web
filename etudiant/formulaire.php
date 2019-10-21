<?php
function formulaire(){
    echo '<form method="post" action="verification.php" id="formulaire">
       <h2 class="text-center">Qui êtes-vous ?</h2>
        <div class="form-group row">
            <div class="col-md-6">
             <label>Nom</label>
              <input type="text" class="form-control" placeholder="Nom"
              name="nom" required>
            </div>
            <div class="col-md-6">             
             <label>Prénom</label>
              <input type="text" class="form-control" placeholder="Prénom"
              name="prenom" required>
            </div>            
            <div class="col-md-6">             
             <label>Adresse mail</label>
              <input type="email" class="form-control" placeholder="Adresse mail"
              name="email" required>
            </div>
            <div class="col-md-6">             
             <label>Numéro de téléphone</label>
              <input type="tel" class="form-control" placeholder="Numéro de téléphone"
              name="tel" required>
            </div>
         </div>
        <h2 class="text-center">Informez nous sur votre stage</h2>
          <div class="form-group row">
                <div class="col-md-6">
                   <label>Titre du stage</label>
                    <input type="text" class="form-control"
                    placeholder="Activité professionnelle" name="titre"
                    required>
                </div>
                <div class="col-md-6">
                   <label>Description du métier lié au stage</label>
                    <input form="formulaire"class="form-control" 
                    placeholder="Décrivez le stage en quelques mots" name="text" required>
                </div>
         </div>
      <div class="form-group row">
                <div class="col-md-4">
                   <label>L\'entreprise du stage</label>
                    <input type="text" class="form-control"
                    placeholder="Entreprise" name="societe"
                    required>
                </div>
      <!--   </div>
      <div class="form-group row"> -->
                <div class="col-md-4">
                   <label>Votre tuteur lors du stage</label>
                    <input type="text" class="form-control"
                    placeholder="Tuteur du stage" name="tuteur" required>
                </div>
                <div class="col-md-4">
                   <label>Son adresse mail</label>
                    <input type="email" class="form-control"
                    placeholder="Adresse Mail (tuteur)" name="email_tuteur"
                    required>
                </div>
         </div>
         <div class="form-group row">
             <div class="col-md-4">
                 <label>Date du début du stage</label>
                 <input type="date" class="form-control" name="debut" required>
             </div>
                <div class="col-md-4">
                 <label>Date du fin du stage</label>
                 <input type="date" class="form-control" name="fin" required>
             </div>
         </div>
         <div class="form-group row center">
            <div class="col">
             <input type="submit" class="btn btn-outline-primary"
             value="Envoyer" name="envoyer">
             </div>
         </div>
        </form>';
    }
?>