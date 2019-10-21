<?php 
    $title="Gestion des stages";
    include("includes/header.php");
    require("auth/config.php");
?>

<div class="container">
   <div class="row">
    <div class="col">
      <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
       <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
       </button>
       <a class="navbar-brand" href="index.php">Flash Stages</a>
        <div class="collapse navbar-collapse" id="navbarToggler">
           <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="<?=$pathFor["home_student"]?>">ETUDIANTS</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$pathFor["home_tutor"]?>">TUTEURS</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$pathFor["home_gestionnaireAdmin"]?>">GESTIONNAIRE ADMINSTRATIF</a></li>
            </ul>
      </div>
    </nav>
   </div>
</div>
  <div class="row">
       <div class="col">
           <div class="jumbotron mt-5">
               <h1 class="center">Bienvenue sur Flash stages</h1>
           </div>
       </div>
    </div>
  <div class="row">
       <div class="col">
           <div class="jumbotron center">
               <h1>Etudiants</h1>
               <h5>Venez créer votre dossier étudiant,consulter le et attendez votre soutenance.</h5>
               <a class="btn btn-outline-primary" href="<?=$pathFor["home_student"]?>">Accéder à l'espace étudiant</a>
           </div>
       </div>
        <div class="col">
           <div class="jumbotron center">
               <h1>Tuteurs</h1>
               <h5>Venez suivre et noter les soutenances auxquelles vous participez.</h5>
              <a class="btn btn-outline-primary" href="<?=$pathFor["home_tutor"]?>">Accéder à l'espace Tuteur</a>
           </div>
       </div>
       <div class="col">
           <div class="jumbotron center">
               <h2>Gestionnaires administratifs</h2>
               <h5>Venez consulter les notes liés aux soutenances.</h5>
               <a class="btn btn-outline-primary" href="<?=$pathFor["home_gestionnaireAdmin"]?>">Accéder à l'espace des gestionnaires</a>
           </div>
       </div>
    </div>
</div>
<?php 
include("includes/footer.php");
?>