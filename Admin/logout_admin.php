<?php
require("auth/EtreAuthentifie.php");

$auth->clear();
$idm->clear();
session_destroy();
redirect($pathFor['root_admin']);