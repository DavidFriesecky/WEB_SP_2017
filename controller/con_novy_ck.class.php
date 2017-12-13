<?php

include_once("model/mod_db.class.php");
include_once("model/mod_ck.class.php");
include_once("model/settings.inc.php");
include_once("model/functions.inc.php");
require_once("htmlpurifier/library/HTMLPurifier.auto.php");

class ConNovyCK {

    /**
     *  Konstruktor
     */
    public function __construct(){}

    /**
     *  Vraci stranku s CK editorem pro psani clanku a recenzi
     *  @return html kod stranky
     */
    public function getResult(){
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        $ck = new ModCK;
        include("view/view_novy_ck.class.php");
        $viewN = new ViewNovyCK;

        $idP = null;
        if (isset($_GET["idP"])) {
            $idP = $purifier->purify($_GET["idP"]);
            $arrPrispevek = $ck->prispevekInfoID($idP);
        }

        $idH = null;
        if (isset($_GET["idH"])) {
            $idH = $purifier->purify($_GET["idH"]);
            $arrRecenze = $ck->recenzeInfoID($idH);
        }

        if ($_SESSION["id_prava"] == 2) {
            return $viewN->getTemplate($_SESSION["jmeno"], $_SESSION["id_prava"], $arrPrispevek["titulek"], $arrPrispevek["text"], $arrRecenze["text"], 0, $idH);
        } else if (isset($arrPrispevek)) {
            return $viewN->getTemplate($_SESSION["jmeno"], $_SESSION["id_prava"], $arrPrispevek["titulek"], $arrPrispevek["text"], null, 1, $idP);
        }

        return $viewN->getTemplate($_SESSION["jmeno"], $_SESSION["id_prava"], null, null, null, 0, null);
    }
}

?>