<?php
function navbarAdminHome($quitter){
      echo'<nav class="navbar navbar-toggleable-md navbar-inverse bg-danger ">
       <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
       </button>
       <a class="navbar-brand" href="../index.php">Flash Stages</a>
        <div class="collapse navbar-collapse" id="navbarToggler">
           <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                    <a class="nav-link" href="index.php?choix=tableau2bord">Tableau de bord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?choix=tuteur">Tuteurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?choix=stages">Stages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?choix=affectation">Affectations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?choix=soutenances">Soutenances</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?choix=gestion_admin">Gestionnaires administratifs</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="'.$quitter.'">Déconnexion</a>
                </li>
           </ul>
      </div>
    </nav>';
}
?>
