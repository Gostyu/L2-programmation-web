<?php

$authTableData = [
    'table' => 'users',
    'idfield' => 'login',
    'cfield' => 'mdp',
    'uidfield' => 'uid',
    'rfield' => 'role',
];

$pathFor = [
    "login"  => "../tuteur/login.php",
    "logout" => "../tuteur/logout.php",
    "home" => "../tuteur/tutor_home.php?choix=etudiants",
	"root"   => "../",
];

const SKEY = '_Redirect';