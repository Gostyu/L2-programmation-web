<?php 
function soutenancesTuteur($db,$SQL,$type_tuteur){
    try{
        $soutenances = $db->prepare($SQL);
        if(isset($_SESSION["tutor_id"]) && is_numeric($_SESSION["tutor_id"])){
            $soutenances->execute(array($_SESSION["tutor_id"]));
            if($soutenances->rowCount()==0){
                
                  echo '<h2>Liste des soutenances en tant que tuteur '.$type_tuteur.'</h2>
                    <div class="alert alert-info text-center" role="alert"><strong>Liste indisponible(vous n\'êtez ni tuteur principal ou ni tuteur secondaire ou vous n\'êtes ni les deux)!</strong>
                    </div>';
            }else{
                echo '
                <h2>Liste des soutenances en tant que tuteur '.$type_tuteur.'</h2>
                    <table class="table table-responsive table-striped table-bordered table-hover center">
                        <thead>
                            <th>Soutenance</th>
                            <th>Titre du stage</th>
                            <th>Date de soutenance</th>                
                            <th>Salle</th>
                        </thead>
                        <tbody>';
                while($soutenance=$soutenances->fetch()){
                    echo '
                        <tr>
                        <th scope="row">'.$soutenance["stid"].'</th>
                        <td>'.$soutenance["titre"].'</td>
                        <td>'.$soutenance["date"].'</td>
                        <td>'.$soutenance["salle"].'</td>
                        </tr>';
                    }
                    echo'</tbody>
                    </table>';
                $soutenances->closeCursor();
            }
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la base de données => ".$e->getMessage());
    }
}
function soutenancesTuteur1($db){
    $SQL="SELECT stid,stages.sid,titre,date,salle FROM soutenances INNER JOIN stages ON soutenances.sid=stages.sid INNER JOIN users ON tuteur1=users.uid WHERE tuteur1 = ?";
    /*liste les soutenances en tant que tuteur principal*/
    soutenancesTuteur($db,$SQL,"principal");
}
function soutenancesTuteur2($db){
    $SQL="SELECT stid,stages.sid,titre, date,salle FROM soutenances INNER JOIN stages ON soutenances.sid=stages.sid
    INNER JOIN users ON tuteur2=users.uid WHERE tuteur2 = ?";
    /*liste les soutenances en tant que tuteur secondaire*/
    soutenancesTuteur($db,$SQL,"secondaire");
}
function soutenances($db){
    soutenancesTuteur1($db);
    soutenancesTuteur2($db);
}


?>