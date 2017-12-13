<?php

include_once("model/mod_db.class.php");
include_once("model/mod_ck.class.php");
include_once("model/settings.inc.php");
include_once("model/functions.inc.php");

class ConUvod {
    /**
     *  Konstruktor
     */
    public function __construct(){

    }

    /**
     *  Vraci uvodni stranku
     *  @return html kod stranky
     */
    public function getResult(){
        $ck = new ModCK;

        $arrPrispevky = $ck->allPrispevkyUserInfo();
        include("view/view_uvod.class.php");
        $viewUvod = new ViewUvod;

        if (!isset($_SESSION["login"]))
            return $viewUvod->getTemplate(false, null, null, $arrPrispevky);
        else
            return $viewUvod->getTemplate(true, $_SESSION["jmeno"], $_SESSION["id_prava"], $arrPrispevky);
    }
}

?>