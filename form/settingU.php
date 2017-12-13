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
$id_pravaD = $_GET["idPrava"];

$id = $purifier->purify($idD);
$id_prava = $purifier->purify($id_pravaD);

$user->updateUserPrava($id, $id_prava);

header("location: ../index.php?page=7");

?>