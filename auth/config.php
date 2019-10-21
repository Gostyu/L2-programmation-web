<?php

$authTableData = [
    'table' => 'users',
    'idfield' => 'login',
    'cfield' => 'mdp',
    'uidfield' => 'uid',
    'rfield' => 'role',
];

$pathFor = [
    "login"  => "../Stages/login.php",
    "logout" => "../Stages/logout.php",
    "adduser" => "../Stages/adduser.php",
	"root"   => "../Stages/",
    "home_student" => "etudiant/student_home.php",
    "home_tutor" => "tuteur/tutor_home.php",
    "home_admin" => "../../Stages/Admin/admin_home.php",
    "home_gestionnaireAdmin"=> "../../Stages/gestionnaireAdmin/home.php",
    "root_student" => "../",
    "root_gesAdmin"=> "../",
];

const SKEY = '_Redirect';