<?php

$authTableData = [
    'table' => 'users',
    'idfield' => 'login',
    'cfield' => 'mdp',
    'uidfield' => 'uid',
    'rfield' => 'role',
];

$pathFor = [
    "login_admin" => "../Admin/login_admin.php",
    "logout_admin" => "../Admin/logout_admin.php",
    "addadmin" => "../Admin/addadmin.php",
    "home_admin" => "/Stages/Admin/index.php?choix=tableau2bord",
    "root_admin" => "/Stages/Admin/",
];

const SKEY = '_Redirect';