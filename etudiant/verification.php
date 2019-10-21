<?php
    include("includes/header.php");
    require("../auth/loader.php");
    require_once("creationDossierEtu.php");
    echo'<div class="container center">
    <h1>Validation de la création de votre dossier</h1>';
 /*Vérifier toutes les données du formulaire
 puis les afficher à l'étudiant et lui proposer de 
 valider la création de son dossier.
*/
$_SESSION["etudiant"]=NULL;
$_SESSION["stage"]=NULL;
if(isset($_POST["envoyer"])){
 if(isset($_POST["nom"],$_POST["prenom"],$_POST["email"],$_POST["tel"],$_POST["titre"],$_POST["text"],$_POST["societe"],$_POST["email_tuteur"],$_POST["debut"],$_POST["fin"]) && (strlen($_POST["tel"])<11)){     
  //infos sur l'etudiant
     $_SESSION['eid']=0;
     $_SESSION['nom']= htmlspecialchars($_POST["nom"]);
     $_SESSION['prenom'] =htmlspecialchars($_POST["prenom"]);
     $_SESSION['email']=htmlspecialchars($_POST["email"]);
     $_SESSION['tel']=htmlspecialchars($_POST["tel"]);
     //infos sur le stage
     $_SESSION['titre']=htmlspecialchars($_POST["titre"]);
     $_SESSION['text'] = htmlspecialchars($_POST["text"]);
     $_SESSION['entreprise']=htmlspecialchars($_POST["societe"]);
     $_SESSION['tuteur']=htmlspecialchars($_POST["tuteur"]);
     $_SESSION['email_tuteur']=htmlspecialchars($_POST["email_tuteur"]);
     $_SESSION['debut']=htmlspecialchars($_POST["debut"]);
     $_SESSION['fin']=htmlspecialchars($_POST["fin"]);
    //affichage du dossier
    verificationDossierEtu();
 }else{
     echo 'Probleme';
 } 
}
/*Vérification de la validation de la création du dossier de stage d'un étudiant*/
if(isset($_POST["validation"])){
    $_SESSION["etudiant"]=nouvelEtudiant($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['email'],$_SESSION['tel']);
     if(ajoutEtudiant($db,$_SESSION["etudiant"])==0){
        /*Dernier etudiant (eid) ajouté*/
        $_SESSION['eid'] = $db->lastInsertId();
         $_SESSION["stage"]=nouveauStage($_SESSION['eid'],$_SESSION['titre'],$_SESSION['text'],
                                         $_SESSION['entreprise'],$_SESSION['tuteur'],$_SESSION['email_tuteur'], $_SESSION['debut'],$_SESSION['fin']);
        if(ajoutStage($db,$_SESSION["stage"])==0){
            /*Dernier stage (sid) ajouté*/
            $_SESSION["refDossier"]=$db->lastInsertId();
            if($_SESSION["refDossier"]!=-1){
                messageConfirmation($pathFor["root_student"]);
            }
        }else{
            messageEchec_ajoutStage();
        }
    }else{
         messageEchec_ajoutEtudiant();
    }
}
echo'</div>';
include("includes/footer.php");?>