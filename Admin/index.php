<?php 
    $title="Espace Adminstrateur";
    include("includes/header.php");
    require_once("navbarAdminHome.php");
    require("../Admin/auth/EtreAuthentifie.php");
    $_SESSION["role"]=$idm->getRole();
    /*actions de l'adminstrateur*/
        //affichage
    require_once("afficheChoix.php");
    require_once("actions/Gestionnaires/regenererToken.php");
        //modifcation
    require_once("actions/Tuteurs/modifStatut.php");
    require_once("actions/Tuteurs/modifMDP.php");  
    require_once("actions/Affectations/modifTuteurP.php");
    require_once("actions/Soutenances/modifTuteurN.php");
        //ajout
    require_once("actions/Gestionnaires/ajoutGestionnaire.php");
    require_once("actions/Soutenances/ajoutSoutenance.php");
        //suppression
    require_once("actions/Stages/supprimerStages.php");
    require_once("actions/Gestionnaires/supprimerGestionnaire.php");
    require_once("actions/Soutenances/supprimerSoutenance.php");
    require_once("actions/Affectations/supprimerAffectation.php");
    if(strcmp($_SESSION["role"],"admin")!=0){
        echo "
        <div class='container center'>
        <div class='alert alert-danger' role='alert'>
        <strong>Accés refusé !<strong>
                <a href='".$pathFor['logout_admin']."' class='btn btn-outline-primary'>Retour à l'accueil</a> 
        </div></div>";
    }else{
?>
<div class="container">
    <div class="row">
        <div class="col">
         <?php navbarAdminHome($pathFor["logout_admin"]);?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php 
            /*Modification du mot de passe d'un tuteur*/
            if(isset($_POST["modifierMDP"]) && is_numeric($_POST["modifierMDP"])){
                if(isset($_POST["nouveauMDP"])){
                    if(modifMDP($db,nouveauMDP($_POST["modifierMDP"],$_POST["nouveauMDP"]))!=0){
                        messageEchec_modifMDP();
                    }else{
                        messageSucces_modifMDP();
                    }
                }
            }
          if(isset($_POST["ajoutTuteur"])){
              require_once("adduser.php");
          }else{
          }
        /*Affichage de la page choisie dans la barre de navigation*/
        if(isset($_GET['choix'])){  
          afficheChoix($db,$_GET["choix"]);
        }else{
            /* 
                Gestion des status des tuteurs et 
                affichage d"un message pour l'activation ou la désactivation d'un tuteur
            */
            if(isset($_GET["statut_on"])){
                if(activationStatut($db,$_GET["statut_on"])!=0){
                    messageEchec_activationStatut();   
                }else{
                    messageSucces_activationStatut();
                }
                afficheTuteurs($db);
            }else if(isset($_GET["statut_off"])){
                if(desactivationStatut($db,$_GET["statut_off"])!=0){
                    messageEchec_desactivationStatut();
                }else{
                    messageSucces_desactivationStatut();
                }
                afficheTuteurs($db);
            }
            /*Ajout d'un gestionnaire par le formulaire*/
                if(isset($_GET["ajoutGestionnaire"]) && strcmp($_GET["ajoutGestionnaire"],"ok")==0){
                    if(isset($_GET["nom"]) && isset($_GET["prenom"]) && isset($_GET["email"])){
                       if(ajoutGestionnaire($db,nouveauGestionnaire($_GET["nom"],$_GET["prenom"],$_GET["email"]))!=0){
                           messageEchec_ajoutGestionnaire();
                       }else{
                           messageSucces_ajoutGestionnaire();
                       }
                    }
                    afficheGestionnaires($db);   
                }else if(isset($_GET["ajoutGestionnaire"]) && strcmp($_GET["ajoutGestionnaire"],"ok")!=0){
                    echo "<h1>ERREUR</h1>";
                }
            /*Suppression d'un gestionnaire adminstratif*/
            if(isset($_GET["sup_gestionnaire"])){
              if(supprimerGestionnaire($db,$_GET["sup_gestionnaire"])!=0){
                  messageEchec_supprimerGestionnaire();
              }else{
                  messageSucces_supprimerGestionnaire();
                }
              afficheGestionnaires($db);
            }
            /*Suppression d'une soutenance*/
            if(isset($_GET["sup_soutenance"])){
                if(supprimerSoutenance($db,$_GET["sup_soutenance"])!=0){
                    messageEchec_supprimerSoutenance();
                }else{
                    messageSucces_supprimerSoutenance();
                }
                afficheSoutenances($db);
            }
            /*Suppresion d'une affectation*/  
            if(isset($_GET["sup_affectation"])){
                  if(supprimerAffectationTuteurP($db,$_GET["sup_affectation"])!=0){
                      messageEchec_supprimerAffectationTuteurP();
                  }else{
                      messageSucces_supprimerAffectationTuteurP();
                  }
                afficheAffectations($db);
              }
            /*Ajout d'un tuteur*/
            /*if(isset($_GET["ajoutTuteur"])){
                if($_GET["ajoutTuteur"]=="oui"){
                    include("adduser.php");
                }
            }*/
            /*Modification du tuteur pégagogique affecté à un stage*/
            if(isset($_GET["idStage"])&&isset($_GET["modifTuteurP"])){    
                if(isset($_GET["tuteurChoisi"])){ 
                    if(changerTuteurP($db,nouveauTuteurP($_GET["tuteurChoisi"],$_GET["idStage"]))!=0){
                        messageEchec_changerTuteurP();
                    }else{
                        messageSucces_changerTuteurP();
                    }
                }
                afficheAffectations($db);
            }
            /*Regéneration du token d'un gestionnaire adminstratif*/
            if(isset($_GET["regenerer"])){
                if(regenererToken($db,nouveauToken($_GET["regenerer"]))!=0){
                    messageEchec_regenererToken();
                }else{
                    messageSucces_regenererToken();
                }
                afficheGestionnaires($db);
            }

            /*Suppression d'un stage*/
            if(isset($_GET["sup_stage"])){
              if(supprimerStages($db,$_GET["sup_stage"])!=0){
                  messageEchec_supprimerStages();
              }else{
                  messageSucces_supprimerStages();
              }
              afficheStages($db);
             }
              /*Modification du tuteur(principal ou secondaire) d'une soutenance*/
              if(isset($_GET["tuteur1Choisi"],$_GET["idSoutenance"],$_GET["modifT1"])){
                        if(modifTuteurN($db,nouveauTuteurN($_GET["idSoutenance"],$_GET["tuteur1Choisi"]),"principal")!=0){
                            messageEchec_modifTuteurN("principal");
                        }else{
                            messageSucces_modifTuteurN("principal");
                        }
                        afficheSoutenances($db);
              }else if(isset($_GET["tuteur2Choisi"],$_GET["idSoutenance"],$_GET["modifT2"])){
                      if(modifTuteurN($db,nouveauTuteurN($_GET["idSoutenance"],$_GET["tuteur2Choisi"]),"secondaire")!=0){
                        messageEchec_modifTuteurN("secondaire");
                    }else{
                        messageSucces_modifTuteurN("secondaire");
                    }
                      afficheSoutenances($db);
              }
            /*Ajout d'une nouvelle soutenance*/
                if(isset($_GET["stage"],$_GET["tuteur1Choisi"] ,$_GET["tuteur2Choisi"],$_GET["datetime"],$_GET["salle"])){
                    if(tuteursIdentiques($_GET["tuteur1Choisi"] ,$_GET["tuteur2Choisi"])!=true){
                        if(ajoutSoutenance($db,nouvelleSoutenance($_GET["stage"],$_GET["tuteur1Choisi"]
                                                      ,$_GET["tuteur2Choisi"],$_GET["datetime"],$_GET["salle"]))!=0){
                          messageEchec_ajoutSoutenance();
                      }else{
                        messageSucces_ajoutSoutenance();   
                      }
                  }else{
                    message_tuteursIdentiques();
                }
                      afficheSoutenances($db);
              }
         /*Ajout d'une affectation de tuteur pédagogique à un stage*/
         if(isset($_GET["stage"]) && isset($_GET["tuteurP"])){
              if(ajoutAffectationTuteurP($db,nouvelleAffectation($_GET["stage"],$_GET["tuteurP"]))!=0){
                  messageEchec_ajoutAffectationTuteurP();
              }else{
                  messageSucces_ajoutAffectationTuteurP();
              }
               afficheAffectations($db);
             }else if(!isset($_GET["stage"]) && isset($_GET["tuteurP"])){
                afficheAffectations($db);   
          }
        }   
        ?>
        </div>
    </div>
</div>
<?php 
}
include("includes/footer.php");
?>