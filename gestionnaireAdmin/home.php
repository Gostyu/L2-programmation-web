 <?php 
    $title="ESPACE GESTIONNAIRE ADMINISTRATIF";
    include("includes/header.php");
    require("../auth/loader.php");
    require_once("formulaire.php");
    //var_dump($_SESSION["gid"]);
    echo '
    <div class="container">
   <div class="row">
           <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top mb-5">
            <a class="navbar-brand" href="../index.php">Flash Stages</a>
           <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                </li>
            </ul>
       </nav>
    </div>
     <div class="container mt-5">
        <div class="row">
            <div class="col">
            <div class="container">
      <h1>Accédez à votre espace de gestionnaire administratif</h1>';
        afficheFormulaire();
    echo'
        </div>
      </div>
    </div>
</div>';
    include("includes/footer.php");
?>