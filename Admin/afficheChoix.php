<?php
require_once("actions/Gestionnaires/afficheGestionnaires.php");
require_once("actions/Soutenances/afficheSoutenances.php");
require_once("actions/Stages/afficheStages.php");
require_once("actions/Tuteurs/afficheTuteurs.php");
require_once("actions/Affectations/afficheAffectations.php");
require_once("actions/Tableau de bord/afficheTableau2bord.php");

function afficheChoix($db,$choix){
        if(strcmp($choix,"tableau2bord")==0){
            afficheTableau2bord($db);
        }else if(strcmp($choix,"tuteur")==0){
            afficheTuteurs($db);
         }else if(strcmp($choix,"stages")==0){
           afficheStages($db);
        }else if(strcmp($choix,"affectation")==0){
           afficheAffectations($db);
        }else if(strcmp($choix,"soutenances")==0){
           afficheSoutenances($db);
        }else if(strcmp($choix,"gestion_admin")==0){
            afficheGestionnaires($db);
        }
}
?>


