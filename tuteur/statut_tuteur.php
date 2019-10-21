<?php 
function get_statut($db,$id_tuteur){
            try{
                $SQL="SELECT actif FROM users WHERE uid=?";
                $user_status=$db->prepare($SQL);
                $user_status->execute(array($id_tuteur));
                if($user_status->rowCount()==0){echo'<div>Impossible de récupérer son statut!</div>';}
                    else{
                        return $user_status->fetch();
                    }
            }catch(\PDOException $e){
                exit("Erreur de connexion à la BD !".$e->getMessage());
            }
        }
?>