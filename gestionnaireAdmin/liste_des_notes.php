<?php 
function selectionOrdre(){
      echo '
        <div class="container mt-5">
        <div class="row">
        <div class="col mt-5 center">
            <h2>Voir la liste des notes par : </h2>
            <form method="post">
                <select name="ordre" class="custom-select">
                    <option value="date">date</option>
                    <option value="nom">nom</option>
                <select>
                <input type="submit" class="btn btn-primary">
            <form>
        </div>
        </div>
        </div>';
}
function listeNotesOrdonnee($db,$ordreChoisi){
    try{
        $SQL="";
        if(strcmp($ordreChoisi,"nom")==0){
         $SQL="SELECT nid, etudiants.nom,etudiants.prenom, note,titre,stid,date FROM notes INNER JOIN soutenances ON notes.sid=soutenances.sid INNER JOIN stages ON soutenances.sid=stages.sid
         INNER JOIN etudiants ON stages.eid=etudiants.eid ORDER BY nom" ;
        }else if(strcmp($ordreChoisi,"date")==0){
         $SQL="SELECT nid, etudiants.nom,etudiants.prenom, note,titre,stid,date FROM notes INNER JOIN soutenances ON notes.sid=soutenances.sid INNER JOIN stages ON soutenances.sid=stages.sid
         INNER JOIN etudiants ON stages.eid=etudiants.eid ORDER BY date" ;
        }
         $notes= $db->prepare($SQL);
         $notes->execute();
         if($notes->rowCount()==0){
            echo "<div>Action indisponible</div>";   
         }else{
             echo'
            <div class="container mt-3">
                <div class="row">
                <table class="table table-responsive table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Stage</th>
                            <th scope="col">Etudiant</th>
                            <th scope="col">Soutenance</th>
                            <th scope="col">Date</th>
                            <th scope="col">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                while($note=$notes->fetch()){
                    echo '
                    <tr>
                        <th scope="row">'.$note["nid"].'</th>
                        <th scope="row">'.$note["titre"].'</th>
                        <th scope="row">'.$note["nom"].' '.$note["prenom"].'</th>
                        <th scope="row">'.$note["stid"].'</th>
                        <th scope="row">'.$note["date"].'</th>
                        <td>'.$note["note"].'</td>
                    </tr>';
                }
                $notes->closeCursor();
                echo'
                </tbody>
            </table>
            </div>
            </div>
            ';
             return 0;
         }
     }catch(\PDOException $e){
        exit("Echec de la connexion avec la BD ".$e->getMessage());
    }
}
function listeNotes($db){
    try{    
         $SQL="SELECT nid, etudiants.nom,etudiants.prenom, note,titre,stid,date FROM notes INNER JOIN soutenances ON notes.sid=soutenances.sid INNER JOIN stages ON soutenances.sid=stages.sid
         INNER JOIN etudiants ON stages.eid=etudiants.eid" ;
         $notes= $db->prepare($SQL);
         $notes->execute();
         if($notes->rowCount()==0){
            echo "<div>Action indisponible</div>";   
         }else{
             echo'
            <div class="container mt-3">
                <div class="row">
                <table class="table table-responsive table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Stage</th>
                            <th scope="col">Etudiant</th>
                            <th scope="col">Soutenance</th>
                            <th scope="col">Date</th>
                            <th scope="col">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                while($note=$notes->fetch()){
                    echo '
                    <tr>
                        <th scope="row">'.$note["nid"].'</th>
                        <th scope="row">'.$note["titre"].'</th>
                        <th scope="row">'.$note["nom"].' '.$note["prenom"].'</th>
                        <th scope="row">'.$note["stid"].'</th>
                        <th scope="row">'.$note["date"].'</th>
                        <td>'.$note["note"].'</td>
                    </tr>';
                }
                $notes->closeCursor();
                echo'
                </tbody>
            </table>
            </div>
            </div>
            ';
             return 0;
         }
     }catch(\PDOException $e){
        exit("Echec de la connexion avec la BD ".$e->getMessage());
    }
}
?>