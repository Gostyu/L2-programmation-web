<?php
function afficheNbEtuTuteurPedagogiquelActif($db){
    $SQL="SELECT sid,stages.tuteurP AS idTuteurP, users.nom,users.prenom, COUNT(*) AS nbEtu FROM stages INNER JOIN users ON stages.tuteurP=users.uid WHERE users.actif=true GROUP BY idTuteurP";
    try{
        $requete=$db->prepare($SQL);
        $requete->execute();
        if($requete->rowCount()==0){
            
        }else{
      echo '
      <h2 class="text-center">Nombre d\'étudiants pour chaque tuteur pédagogique actif</h2>
      <div class="table-responsive">
       <table class="table table-striped table-bordered">
        <thead>
            <th scope="col">#</th>
            <th scope="col">idTuteur1</th>
            <th scope="col">Tuteur principal actif</th>
            <th scope="col">Nombre d\'étudiants</th>
        </thead>
        <tbody>';
                while($row=$requete->fetch()){
                    echo '
                    <tr class="text-center">
                        <th scope="row">'.$row["sid"].'</th>
                        <td>'.$row["idTuteurP"].'</td>
                        <td>'.$row["nom"].' '.$row["prenom"].'</td>
                        <td>'.$row["nbEtu"].'</td>
                    </tr>';
                }
            $requete->closeCursor();
            echo '
        </tbody>
    </table>
    </div>';
        }
    }catch(\PDOException $e){
        exit("Echec de connexion à la BD ".$e->getMessage());
    }
}
function afficheNbEtuTuteurPrincipalActifSoutenances($db){
    $SQL="
SELECT stid,soutenances.tuteur1,users.nom,users.prenom,COUNT(*) AS nbEtu FROM soutenances
 INNER JOIN stages ON soutenances.sid=stages.sid INNER JOIN users WHERE soutenances.tuteur1=uid GROUP BY tuteur1
ORDER BY stid";
    try{
        $requete=$db->prepare($SQL);
        $requete->execute();
        if($requete->rowCount()==0){
            
        }else{
      echo '
      <h2 class="text-center">Nombre d\'étudiants pour chaque tuteur principal actif pour une soutenance</h2>
      <div class="table-responsive">
       <table class="table table-striped table-bordered">
        <thead>
            <th scope="col">#Soutenance</th>
            <th scope="col">idTuteur1</th>
            <th scope="col">Tuteur principal actif</th>
            <th scope="col">Nombre d\'étudiants</th>
        </thead>
        <tbody>';
                while($row=$requete->fetch()){
                    echo '
                    <tr class="text-center">
                        <th scope="row">'.$row["stid"].'</th>
                        <td>'.$row["tuteur1"].'</td>
                        <td>'.$row["nom"].' '.$row["prenom"].'</td>
                        <td>'.$row["nbEtu"].'</td>
                    </tr>';
                }
            $requete->closeCursor();
            echo '
        </tbody>
    </table>
    </div>';
        }
    }catch(\PDOException $e){
        exit("Echec de connexion à la BD ".$e->getMessage());
    }
}
function afficheNbEtuTuteurSecondaireActifSoutenances($db){
    $SQL="SELECT stid,soutenances.tuteur2,users.nom,users.prenom,COUNT(*) AS nbEtu 
FROM soutenances INNER JOIN stages ON soutenances.sid=stages.sid INNER JOIN users
 WHERE soutenances.tuteur2=uid GROUP BY tuteur2 ORDER BY stid";
    try{
        $requete=$db->prepare($SQL);
        $requete->execute();
        if($requete->rowCount()==0){
            
        }else{
      echo '
      <h2 class="text-center">Nombre d\'étudiants pour chaque tuteur secondaire actif pour une soutenance</h2>
      <div class="table-responsive">
       <table class="table table-striped table-bordered">
        <thead>
            <th scope="col">#Soutenance</th>
            <th scope="col">idTuteur2</th>
            <th scope="col">Tuteur secondaire actif</th>
            <th scope="col">Nombre d\'étudiants</th>
        </thead>
        <tbody>';
                while($row=$requete->fetch()){
                    echo '
                    <tr class="text-center">
                        <th scope="row">'.$row["stid"].'</th>
                        <td>'.$row["tuteur2"].'</td>
                        <td>'.$row["nom"].' '.$row["prenom"].'</td>
                        <td>'.$row["nbEtu"].'</td>
                    </tr>';
                }
            $requete->closeCursor();
            echo '
        </tbody>
    </table>
    </div>';
        }
    }catch(\PDOException $e){
        exit("Echec de connexion à la BD ".$e->getMessage());
    }
}
function afficheTableau2Bord($db){
    afficheNbEtuTuteurPedagogiquelActif($db);
    afficheNbEtuTuteurPrincipalActifSoutenances($db);
    afficheNbEtuTuteurSecondaireActifSoutenances($db);
}
?>