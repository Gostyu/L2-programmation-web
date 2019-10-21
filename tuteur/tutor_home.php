<?php

$title="ESPACE TUTEUR";
include("includes/header.php");
require("auth/EtreAuthentifie.php");
require_once("statut_tuteur.php");
require_once("actionsTuteur.php");
    $_SESSION["role"]=$idm->getRole();
    $_SESSION["tutor_id"]=$idm->getUid();
    $_SESSION["statut"]=0;
    if(strcmp($_SESSION["role"],"user")!=0){
            usersNonAutorises($pathFor['root']);
    }else{
        //récupération du statut (actif ou passif ) du tuteur pédagogique
    $statut=get_statut($db,$_SESSION["tutor_id"]);
        if(is_numeric($statut["actif"])){
            $_SESSION["statut"]=$statut["actif"];
            if($_SESSION["statut"]!=1){
                usersNonAutorises($pathFor['logout']);
            }else{
            /*Espace Tuteur pédagogique actif*/
            navBarTuteurActif($pathFor["logout"]);
             if(isset($_GET["choix"])){
                if(isset($_POST["valider"],$_POST["note"],$_POST["idNote"])){
                     nouvelleNote($db,$_POST["note"],$_POST["idNote"]);
                 }
                if(isset($_POST["valider2"],$_POST["commentaire"],$_POST["idCommentaire"])){
                    nouveauCommentaire($db,$_POST["commentaire"],$_POST["idCommentaire"]);
                }
            /*if(isset($_GET["?ajoutNote"]) && strcmp($_GET["?ajoutNote"],"oui")==0){
                echo "<h1>OK</h1>";
                }else{echo "<h1>ERREUR</h1>";}*/
                 if(isset($_POST["ajouter"],$_POST["noteModal"],$_POST["stageModal"],$_POST["commentaireModal"])){
                    // echo "<h1>OK MODAL</h1>"; 
                     //var_dump(notation($_POST["stageModal"],$_POST["noteModal"],$_POST["commentaireModal"]));
                     notationSoutenance($db,$_POST["stageModal"],$_POST["noteModal"],$_POST["commentaireModal"]);
                     //var_dump($_POST["noteModal"]);
                     //var_dump($_POST["stageModal"]);
                     //var_dump($_POST["commentaireModal"]);
                 }
                    actionsTuteurActif($db,$_GET["choix"]);
            }
          }
        }
    echo '</div>';
    }
    include("includes/footer.php");
?>