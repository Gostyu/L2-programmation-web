<?php
function nouveauGestionnaire($nom,$prenom,$email){
    if(!empty($nom)&& !empty($prenom)){
        return array(
            'nom' => htmlspecialchars($nom),
            'prenom' => htmlspecialchars($prenom),
            'email' => htmlspecialchars($email),
            'token' => bin2hex(random_bytes(26))
        );
    }
    return NULL;
}
function messageSucces_ajoutGestionnaire(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Ajout réussi !</strong></div>";
}
function messageEchec_ajoutGestionnaire(){
    echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Echec de l'ajout !</strong></div>";
}
function ajoutGestionnaire($db,$nouveauGestionnaire){
    try{
        $SQL="INSERT INTO gestionnaires (nom,prenom,email,token) VALUES (?,?,?,?)";
        $requete=$db->prepare($SQL);
        if(!empty($nouveauGestionnaire)){
            $requete->execute(array($nouveauGestionnaire["nom"],$nouveauGestionnaire["prenom"],$nouveauGestionnaire["email"],$nouveauGestionnaire["token"]));
        }
        if($requete->rowCount()==0){
            return -1;
        }else{
            return 0;
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD ".$e->getMessage());
    }
}
?>