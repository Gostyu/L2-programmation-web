<?php
/*Fonctions d'affichage des actions selon le statut d"un tuteur*/
require_once("changerMDP.php");
require_once("liste_soutenances.php");
require_once("liste_etudiants.php");
require_once("notes.php");
function actionsTuteurActif($db,$choix){
    if(strcmp($choix,"etudiants")==0){
        listeEtudiants($db);
      }else if(strcmp($choix,"soutenances")==0){
        soutenances($db);
      }else if(strcmp($choix,"notes")==0){
        afficheNotes($db);
      }else if(strcmp($choix,"changer_mdp")==0){
        changerMDP($db);
      }
}
function usersNonAutorises($quitter){
        echo "<div class='container center'>
                <div class='alert alert-danger' role='alert'>
                    <strong>Accés refusé !<strong>
                    <a href='".$quitter."' class='btn btn-outline-primary'>Retour à l'accueil</a> 
                </div>
            </div>";
    session_destroy();
}
function navBarTuteurActif($quitter){
echo'<div class="container">
        <div class="row">
            <div class="col">
                   <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
                       <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                       </button>                
                       <a class="navbar-brand" href="../index.php">Espace Tuteur</a>
                 <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav ml-auto">
                       <!-- <li class="nav-item"><a class="nav-link" href="?choix=etudiants">Voir la liste des étudiants</a></li>
                        <li class="nav-item"><a class="nav-link" href="?choix=soutenances">Voir la liste des soutenances</a></li>
                        -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Consulter
                            </a>
                               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                   <div class="dropdown-header">la liste des</div>
                                    <a class="dropdown-item" href="?choix=etudiants">étudiants</a>
                                    <a class="dropdown-item" href="?choix=soutenances">soutenances</a>
                                    <a class="dropdown-item" href="?choix=notes">notes</a>
                               </div>
                        </li>
                       <!-- <li class="nav-item"><a class="nav-link" href="?choix=notes">Notes</a></li> -->          
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Paramétres du compte
                            </a>
                               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class=" dropdown-item" href="?choix=changer_mdp">Changer de mot de passe</a>
                               </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="'.$quitter.'">Déconnexion</a></li>  
                    </ul>
                 </div>
                </nav>
             </div>
     </div>';
}
?>