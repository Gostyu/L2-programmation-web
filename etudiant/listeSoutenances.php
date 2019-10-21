<?php 
function listeSoutenances($db){
    $SQL="SELECT stid,titre,etudiants.nom AS nomEtu,etudiants.prenom AS prenomEtu,t1.nom AS nomT1,t1.prenom AS prenomT1, t2.nom AS nomT2,t2.prenom AS prenomT2, date, salle FROM soutenances INNER JOIN stages ON soutenances.sid=stages.sid INNER JOIN users t1 ON soutenances.tuteur1=t1.uid 
INNER JOIN users t2 ON t2.uid=soutenances.tuteur2 INNER JOIN etudiants ON etudiants.eid=stages.eid  
ORDER BY etudiants.nom";
    try{
        $soutenances=$db->prepare($SQL);
        $soutenances->execute();
        if($soutenances->rowCount()==0){
            echo "<div>Action indisponible</div>";
        }else{
        echo'
        <div class="container>
            <div class="row">
        <h2 class="text-center">Soutenances</h2>
            <div class="table-responsive text-center">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Numéro de soutenance</th>
                        <th scope="col">Stage</th>
                        <th scope="col">Etudiant</th>
                        <th scope="col">Tuteur principal</th>
                        <th scope="col">Tuteur secondaire</th>
                        <th scope="col">Date et lieu</th>
                    </tr>
                </thead>
                <tbody>
                ';
            while($soutenance=$soutenances->fetch()){
                echo '
                <tr>
                    <td>'.$soutenance["stid"].'</td>
                    <td>'.$soutenance["titre"].'</td>
                    <td>'.$soutenance["nomEtu"].' '.$soutenance["prenomEtu"].'</td>
                    <td>'.$soutenance["nomT1"].' '.$soutenance["prenomT1"].'</td>
                    <td>'.$soutenance["nomT2"].' '.$soutenance["prenomT2"].'</td>
                    <td>'.$soutenance["date"].' '.$soutenance["salle"].'</td>
                </tr>';
            }
            $soutenances->closeCursor();
            echo'
            </tbody>
        </table>
        </div>
        </div>
        </div>
        ';
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD".$e->getMessage());
    }
}
?>