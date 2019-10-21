<?php
function nouvelEtudiant($nom,$prenom,$email,$tel){
    if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($tel)){
        return array('nom'=> $nom,'prenom'=> $prenom,'email'=> $email,'tel'=> $tel);
    }
 return NULL;
}

function nouveauStage($eid,$titre,$description,$entreprise,$tuteurE,$emailTuteurE,$debut,$fin){
    if(is_numeric($eid) && !empty($titre) && !empty($description) && !empty($entreprise) && !empty($tuteurE)
       &&!empty($emailTuteurE)&&!empty($debut)&&!empty($fin)){
        return array(
            'eid'=>$eid,
            'titre'=> $titre,
            'texte'=> $description,
            'entreprise'=> $entreprise,
            'tuteurE'=> $tuteurE,
            'emailTuteurE'=> $emailTuteurE,
            'dateDebut'=>$debut,
            'dateFin'=> $fin
        );
    }
    return NULL;
}
function ajoutEtudiant($db,$nouvelEtudiant){
      $SQL="INSERT INTO etudiants(nom, prenom,email,tel)VALUES(?,?,?,?)";
    try{
        $etudiant = $db->prepare($SQL);
        if(!empty($nouvelEtudiant)){
            $etudiant->execute(array($nouvelEtudiant['nom'],$nouvelEtudiant['prenom'],
                $nouvelEtudiant['email'],$nouvelEtudiant['tel']));
        }
        if($etudiant->rowCount()==0){
            return -1;
        }else{
            return 0 ;
        }
    }catch(\PDOException $e){
        exit("ajoutEtudiant:Echec de la requête !".$e->getMessage());
    }
}
function ajoutStage($db,$nouveauStage){
    $SQL="INSERT INTO stages(eid,titre,description,entreprise,tuteurE,emailTE,
            tuteurP,dateDebut,dateFin)VALUES(?,?,?,?,?,?,?,?,?)";
    try{
        $stage=$db->prepare($SQL);
        if(!empty($nouveauStage)){
            $stage->execute(array($nouveauStage['eid'],$nouveauStage['titre'],$nouveauStage['texte'],$nouveauStage["entreprise"],$nouveauStage['tuteurE'],$nouveauStage['emailTuteurE'], NULL, $nouveauStage['dateDebut'],$nouveauStage['dateFin']));
        }
        if($stage->rowCount()==0){
            return -1;
        }else{
            return 0 ;
        }
    }catch(\PDOException $e){
        exit("ajoutStage:Echec de la requête !".$e->getMessage());
    }
}
function messageEchec_ajoutEtudiant(){
     echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Echec de l'ajout d\'un étudiant.</strong></div>";
}
function messageEchec_ajoutStage(){
     echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Echec de l\'ajout d\'un stage</strong></div>";
}
function messageConfirmation($quitter){
     echo "<div class='row alert alert-success' role='alert'>
        <strong>Votre dossier a bien été crée !
        Conservez bien votre référence de dossier afin de pouvoir consulter votre attribution.<strong>
                <a href='".$quitter."' class='btn btn-outline-primary'>Retour à l'accueil</a> 
        </div>";
        echo "<strong>Votre référence est ".$_SESSION["refDossier"]."AE92NE</strong>";
        session_destroy();
}
function verificationDossierEtu(){
echo "
     <form method='post'>
     <table>
        <tbody>
        <th>Nom<th>
            <tr><td>".$_SESSION['nom']."</td></tr>
        <th>Prénom<th>
            <tr><td>".$_SESSION['prenom']."</td></tr>
        <th>Votre adresse mail</th>
            <tr><td>".$_SESSION['email']."</td></tr>
        <th>Téléphone</th>
            <tr><td>".$_SESSION['tel']."</td></tr>
        <th>Activité professionnelle</th>
            <tr><td>".$_SESSION['titre']."</td></tr>
        <th>Description sur le stage</th>
            <tr><td>".$_SESSION['text']."</td></tr>
        <th>Entreprise</th>
            <tr><td>".$_SESSION["entreprise"]."</td></tr>
        <th>Date du début du stage</th>
            <tr><td>".$_SESSION['debut']."</td></tr>
         <th>Date de fin du stage</th>
            <tr><td>".$_SESSION['fin']."</td></tr>
        </tbody>
     </table>
     <div class='form-group row'>
            <div class='col'>
             <input type='submit' class='btn btn-outline-primary'
              name='validation' value='Valider'>
             </div>
         </div>
     </form>";
}
?>