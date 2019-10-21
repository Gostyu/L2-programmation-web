<?php

require("../Admin/auth/loader.php");


if (!$idm->hasIdentity()) {
            $_SESSION[SKEY] = $_SERVER['REQUEST_URI'];
            redirect($pathFor['login_admin']);
            exit();
        };
