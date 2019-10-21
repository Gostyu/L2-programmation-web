<?php

if (empty($_POST['login'])) {
    include('adduser_form.php');
    exit();
}

$error = "";

foreach (['nom', 'prenom', 'login', 'mdp', 'mdp2'] as $name) {
    if (empty($_POST[$name])) {
        $error .= "La valeur du champs '$name' ne doit pas être vide";
    } else {
        $data[$name] = $_POST[$name];
    }
}

function messageLoginDejaUtilise(){
    return ' <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <strong>Login déjà utilisé</strong> 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
}
function messageMDPIdentiques(){
    return '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
  <strong>Les mots de passe ne correspondent pas</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
// Vérification si l'utilisateur existe
$SQL = "SELECT uid FROM users WHERE login=?";
$stmt = $db->prepare($SQL);
$res = $stmt->execute([$data['login']]);

if ($res && $stmt->fetch()) {
    $error .= messageLoginDejaUtilise();
}

if ($data['mdp'] != $data['mdp2']) {
    $error .= messageMDPIdentiques();
}

if (!empty($error)) {
   include('adduser_form.php');
    exit();
}


foreach (['nom', 'prenom', 'login', 'mdp'] as $name) {
    $clearData[$name] = $data[$name];
}

$passwordFunction =
    function ($s) {
        return password_hash($s, PASSWORD_DEFAULT);
    };

$clearData['mdp'] = $passwordFunction($data['mdp']);
function messageSucces_ajoutTuteur(){
    echo '
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>Ajout réussi !</strong> 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
}
function messageEchec_ajoutTuteur(){
      echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong><h1>Echec de l\'ajout d\'un utilisateur!</h1></strong> 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
}
try {
    $SQL = "INSERT INTO users(nom,prenom,login,mdp) VALUES (:nom,:prenom,:login,:mdp)";
    $stmt = $db->prepare($SQL);
    $res = $stmt->execute($clearData);
    if($res!=0){
        messageSucces_ajoutTuteur();
    }else{
       messageEchec_ajoutTuteur();
    }
}catch (\PDOException $e) {
    http_response_code(500);
    echo "Erreur de serveur.";
    exit();
}




