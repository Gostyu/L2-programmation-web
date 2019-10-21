<?php
$title="ESPACE ETUDIANT";
include("includes/header.php");
require("../auth/loader.php");
require_once("listeSoutenances.php");
require_once("formulaire.php");
require_once("student_home_navbar.php");
//$_SESSION["reference"]=0;
    /*navbar de la page student_home*/
echo'<div class="container">';
    navbarStudentHome();
    if(isset($_GET["choix"])){
        if($_GET["choix"]=="creer"){
            formulaire();
        }else if($_GET["choix"]=="consulter"){
            include("consulter.php");
        }else if($_GET["choix"]=="soutenances"){
            listeSoutenances($db);
        }
    }else{
        formulaire();
    }
 echo "</div>";
include("includes/footer.php");
?>

 