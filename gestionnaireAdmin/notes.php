<?php
    $title="ESPACE GESTIONNAIRE ADMINISTRATIF";
    include("includes/header.php");
    require("../auth/loader.php");
    require_once("formulaire.php");
    require_once("liste_des_notes.php");
    $_SESSION["token"]="";
    $token=NULL;
    $_SESSION["email"]=NULL; 
          navbarGestionnaire($pathFor['root_gesAdmin']);
    if(isset($_POST["connexion"],$_POST["email"])){
          $_SESSION["email"]=$_POST["email"];
    
    $_SESSION["gid"]=verification($db,htmlspecialchars($_SESSION["email"]));
           if($_SESSION["gid"]<=0){
                accesRefuse($pathFor['root_gesAdmin']);
            }else{
                $_SESSION["token"]=getToken($db,$_SESSION["gid"]);
               if(isset($_SESSION["token"])){
                echo'<div class="container mt-5">
                        <div class="row">
                            <div class="col mx-auto">';
                    afficheFormulaireToken($_SESSION["token"]);
                echo '
                        </div>
                    </div>
                </div>';
                }
           }
    }
if(isset($_GET["valider"]) && $_GET["valider"]=="ok"){
      selectionOrdre();
    if(isset($_POST["ordre"])){
        if($_POST["ordre"]=="date"){
            listeNotesOrdonnee($db,$_POST["ordre"]);
        }else if($_POST["ordre"]=="nom"){
          listeNotesOrdonnee($db,$_POST["ordre"]);
        }
    }else{
        listeNotes($db);
    }
 }else if(isset($_GET["accesNotes"])&&!empty($_GET["accesNotes"]) && verificationToken($db,htmlspecialchars($_GET["accesNotes"]))==true){
        selectionOrdre();
        if(isset($_POST["ordre"])){
            if($_POST["ordre"]=="date"){
                listeNotesOrdonnee($db,$_POST["ordre"]);
            }else if($_POST["ordre"]=="nom"){
                listeNotesOrdonnee($db,$_POST["ordre"]);
            }
        }else{
            listeNotes($db);   
        }
    }
include("includes/footer.php");
?>