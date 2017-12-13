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

$idD = $_GET["id"];
$id_banD = $_GET["idBan"];

$id = $purifier->purify($idD);
$id_ban = $purifier->purify($id_banD);

$user->updateUserBan($id, $id_ban);

header("location: ../index.php?page=7");

?>