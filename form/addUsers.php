<?php
session_start();

include_once("../model/mod_db.class.php");
include_once("../model/mod_user.class.php");
include_once("../model/mod_ck.class.php");
include_once("../model/settings.inc.php");
include_once("../model/functions.inc.php");
require_once("../htmlpurifier/library/HTMLPurifier.auto.php");

$ck = new ModCK;
$user = new ModUser;
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

$idD = $_GET["id"];

$id = $purifier->purify($idD);

$arrRecenzenti = $user->allRecenzentInfo();

$userIf = "";
print_r($_POST);
foreach ($arrRecenzenti as $index => $item) {
    $idPom = "id".$item["id_uzivatel"];
    $userIf = $_POST[$idPom];
    print_r($userIf);
    if ($userIf == "true") {
        $ck->insertTextRecenzentNew(null, null, 0, $item["id_uzivatel"], $id);
    }
}

header("location: ../index.php?page=6");

?>