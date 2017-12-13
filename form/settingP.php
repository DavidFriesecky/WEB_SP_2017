<?php
session_start();

include_once("../model/mod_db.class.php");
include_once("../model/mod_ck.class.php");
include_once("../model/settings.inc.php");
include_once("../model/functions.inc.php");
require_once("../htmlpurifier/library/HTMLPurifier.auto.php");

$ck = new ModCK;
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

$idD = $_GET["id"];
$id_publicD = $_GET["idPublic"];

$id = $purifier->purify($idD);
$id_public = $purifier->purify($id_publicD);

$ck->updatePrispevkyPublic($id, $id_public);

header("location: ../index.php?page=6");

?>