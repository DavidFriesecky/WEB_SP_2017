<?php

include_once("model/mod_db.class.php");
include_once("model/mod_ck.class.php");
include_once("model/mod_user.class.php");
include_once("model/settings.inc.php");
include_once("model/functions.inc.php");

class ConSRecenzent {
    /**
     *  Konstruktor
     */
    public function __construct(){

    }

    /**
     *  Vraci stranku se seznamem pridelenych clanku k recenzi recenzentovi
     *  @return html kod stranky
     */
    public function getResult(){
        $ck = new ModCK;
        include("view/view_seznam_recenzent.class.php");
        $viewSRecenzent = new ViewSRecenzent;

        $arrRecenze = $ck->allRecenzeInfoR();

        return $viewSRecenzent->getTemplate($_SESSION["jmeno"], $arrRecenze);
    }
}

?>