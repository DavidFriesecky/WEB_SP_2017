<?php

include_once("model/mod_db.class.php");
include_once("model/mod_ck.class.php");
include_once("model/mod_user.class.php");
include_once("model/settings.inc.php");
include_once("model/functions.inc.php");

class ConSAdminP {
    /**
     *  Konstruktor
     */
    public function __construct(){

    }

    /**
     *  Vraci stranku se seznamem prispevku pro administratora
     *  @return html kod stranky
     */
    public function getResult(){
        $ck = new ModCK;
        $user = new ModUser;
        include("view/view_seznam_adminP.class.php");
        $viewSAdminP = new ViewSAdminP;

        $arrPrispevky = $ck->allPrispevkyUserInfo();
        $arrRecenze = $ck->allRecenzeUserInfo();
        $arrRecenzenti = $user->allRecenzentInfo();

        $id = null;
        if (isset($_GET["id"])) $id = $_GET["id"];

        return $viewSAdminP->getTemplate($_SESSION["jmeno"], $arrPrispevky, $arrRecenze, $arrRecenzenti, $id);
    }
}

?>