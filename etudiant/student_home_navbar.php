<?php
function navbarStudentHome(){
echo'<div class="row">
          <div class="col">
               <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                   <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                   </button>
                   <a class="navbar-brand" href="../index.php">Espace Etudiant</a>
                    <div class="collapse navbar-collapse" id="navbarToggler">
                       <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="?choix=creer">Créer votre dossier</a></li>
                            <li class="nav-item"><a class="nav-link" href="?choix=consulter">Consulter votre dossier</a></li>
                            <li class="nav-item"><a class="nav-link" href="?choix=soutenances">Consulter la liste des soutenances</a></li>
                        </ul>
                  </div>
           </nav>
    </div>
</div>';
}
?>
