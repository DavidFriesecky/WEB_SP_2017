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

$nameDirty = $_POST["jmeno"];
$loginDirty = $_POST["login"];
$password1Dirty = $_POST["heslo1"];
$password2Dirty = $_POST["heslo2"];
$emailDirty = $_POST["email"];

$name = $purifier->purify($nameDirty);
$login = $purifier->purify($loginDirty);
$password1 = $purifier->purify($password1Dirty);
$password2 = $purifier->purify($password2Dirty);
$password1SHA1 = sha1($password1);
$password2SHA1 = sha1($password2);
$email = $purifier->purify($emailDirty);

if (isset($name) && isset($login) && isset($password1SHA1) && isset($password2SHA1) && isset($email)
    && $name != "" &&  $login != "" && $password1SHA1  != "" &&  $password2SHA1 != "" && $email  != "") {
    $user->userRegister($name, $login, $password1SHA1, $password2SHA1, $email);

    if (isset($_SESSION["incorrectRegister"]) && ($_SESSION["incorrectRegister"] == "1" || $_SESSION["incorrectRegister"] == "2" || $_SESSION["incorrectRegister"] == "3")) {
        header("location: ../index.php?page=2");
    } else {
        header("location: ../index.php?page=1");
    }
} else {
    $_SESSION["incorrectRegister"] = "0";
    header("location: ../index.php?page2");
}

?>