<?php 
function afficheListeEtudiantsTuteur($db,$type_tuteur){
    $SQL="SELECT etudiants.nom AS nom_etudiant, etudiants.prenom AS prenom_etudiant,titre AS stage FROM etudiants INNER JOIN stages ON etudiants.eid=stages.eid 
INNER JOIN users ON stages.tuteurP=users.uid WHERE stages.tuteurP=?";
    try{
        $students=$db->prepare($SQL);
        if(isset($_SESSION["tutor_id"]) &&is_numeric($_SESSION["tutor_id"])){
            $res=$students->execute(array($_SESSION["tutor_id"]));
        }
            if($students->rowCount()==0){
                  echo '<h2>Liste des étudiants en tant que tuteur '.$type_tuteur.'</h2>
                  <div class="alert alert-info text-center" role="alert"><strong>Liste indisponible(vous n\'êtez pas tuteur '.$type_tuteur.')!</strong>
                    </div>';
            }else{
                    echo'
                <h2>Liste des étudiants en tant que tuteur '.$type_tuteur.'</h2>
                <table class="table table-responsive table-striped table-bordered table-hover center">
                    <thead>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Stage</th>
                    </thead>
                    <tbody>';
            while($student=$students->fetch()){
                echo '<tr>
                        <td>'.$student["nom_etudiant"].'</td>
                        <td>'.$student["prenom_etudiant"].'</td>
                        <td>'.$student["stage"].'</td>
                     </tr>';
                }
        $students->closeCursor();
            echo'</tbody>
            </table>';  
            }
    }catch(\PDOException $e){
        exit("Echec lors de la connexion à la base de données. => ".$e->getMessage());
    }
 }
/* requete pour obtenir la liste des etudiants en tant que tuteur principal*/
function listeEtuTuteurP($db){
    afficheListeEtudiantsTuteur($db,"pédagogique");
}
/* requete pour obtenir la liste des etudiants en tant que tuteur secondaire
function listeEtuTuteur2($db){
    $SQL="SELECT etudiants.nom AS nom_etudiant, etudiants.prenom AS prenom_etudiant FROM users INNER JOIN soutenances ON users.uid=soutenances.tuteur2 INNER JOIN stages ON soutenances.sid=stages.sid INNER JOIN etudiants ON etudiants.eid=stages.eid WHERE soutenances.tuteur2=?";
   afficheListeEtudiantsTuteur("secondaire",$db,$SQL);
}*/
function listeEtudiants($db){
    listeEtuTuteurP($db);
  //  listeEtuTuteur2($db);
}
    
?>










