<?php
session_start();

include_once("../model/mod_db.class.php");
include_once("../model/mod_user.class.php");
include_once("../model/settings.inc.php");
include_once("../model/functions.inc.php");

$user = new ModUser;
$user->userLogout();

header("location: ../index.php?page=1");

?>