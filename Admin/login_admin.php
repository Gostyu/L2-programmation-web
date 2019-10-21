<?php
include("auth/EtreInvite.php");

// Check if it is the first visit
if ((empty($_POST['login']) && empty($_POST['password']))) {
    include('login_admin_form.php');
    exit();
}

$error = "";

foreach (['login', 'password'] as $name) {
    if (empty($_POST[$name])) {
        $error .= '<div class="col"><div class=" alert alert-warning alert-dismissible fade show center" role="alert">
            <strong>La valeur du champs '.$name.' ne doit pas être vide</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div></div>';
    }
}

// do the next step if no errors
if (empty($error)) {
    $data['login'] = $_POST['login'];
    $data['password'] = $_POST['password'];
    if (!$auth->existIdentity($data['login'])) {
        $error =  '<div class="col"><div class=" alert alert-danger alert-dismissible fade show center" role="alert">
            <strong>Utilisateur inexistant</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div></div>';
    }
}

// do the next step if no errors
if (empty($error)) {
    $role = $auth->authenticate($data['login'], $data['password']);
    if (!$role) {
        $error = '<div class="col"><div class=" alert alert-danger alert-dismissible fade show center" role="alert">
            <strong>Echec de l\'authentification</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div></div>';
    }
}

// if errors then stop

if (!empty($error)) {
    include('login_admin_form.php');
    exit();
}


// Redirect to the original location
// ToDo: Try to have a nicer $_SESSION usage...

if (isset($_SESSION[SKEY])) {
    $uri = $_SESSION[SKEY];
    unset($_SESSION[SKEY]);
    redirect($pathFor['home_admin']);
    exit();
}
redirect($pathFor['home_admin']);



