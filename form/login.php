<?php
session_start();

include_once("../model/mod_db.class.php");
include_once("../model/mod_user.class.php");
include_once("../model/settings.inc.php");
include_once("../model/functions.inc.php");
require_once("../htmlpurifier/library/HTMLPurifier.auto.php");

$user = new ModUser;
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

$loginDirty = $_POST["login"];
$passwordDirty = $_POST["heslo"];

$login = $purifier->purify($loginDirty);
$password = $purifier->purify($passwordDirty);
$passwordSHA1 = sha1($password);

$user->userLogin($login, $passwordSHA1);

if(!$user->isUserLogged()) {
    header("location: ../index.php?page=1");
} else {
    header("location: ../index.php?page=0");
}

?>