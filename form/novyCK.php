<?php
session_start();

include_once("../model/mod_db.class.php");
include_once("../model/mod_ck.class.php");
include_once("../model/settings.inc.php");
include_once("../model/functions.inc.php");
require_once("../htmlpurifier/library/HTMLPurifier.auto.php");

$text = new ModCK;
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

if ($_SESSION["id_prava"] == 2) {
    $stav = $_POST["stav"];
    $clanekD = $_POST["editor1"];
    $idD = $_GET["id"];

    $clanek = $purifier->purify($clanekD);
    $id = $purifier->purify($idD);

    print_r($clanek);
    print_r(intval($stav));
    print_r(intval($id));

    $text->insertTextRecenzent($clanek, $stav, $id);
    header("location: ../index.php?page=5");

} else if ($_SESSION["id_prava"] == 3) {
    if ($_GET["edit"] == 1) {
        $titulekD = $_POST["titulek"];
        $clanekD = $_POST["editor1"];
        $idD = $_GET["id"];

        $titulek = $purifier->purify($titulekD);
        $clanek = $purifier->purify($clanekD);
        $id = $purifier->purify($idD);

        $text->updatePrispevkyText($id, $titulek, $clanek);
        header("location: ../index.php?page=4");

    } else {
        $titulekD = $_POST["titulek"];
        $clanekD = $_POST["editor1"];

        $titulek = $purifier->purify($titulekD);
        $clanek = $purifier->purify($clanekD);

        $text->insertTextAutor($titulek, $clanek);
        header("location: ../index.php?page=4");
    }

}



?>