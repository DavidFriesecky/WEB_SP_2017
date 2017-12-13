<?php

include_once("model/mod_db.class.php");
include_once("model/mod_ck.class.php");
include_once("model/mod_user.class.php");
include_once("model/settings.inc.php");
include_once("model/functions.inc.php");

class ConSAutor {
    /**
     *  Konstruktor
     */
    public function __construct(){

    }

    /**
     *  Vraci stranku se seznamem autorovych clanku
     *  @return html kod stranky
     */
    public function getResult(){
        $ck = new ModCK;
        include("view/view_seznam_autor.class.php");
        $viewSAutor = new ViewSAutor;

        $arrPrispevky = $ck->allPrispevkyInfoA();
        $arrRecenze = $ck->allRecenzeInfoA();

        return $viewSAutor->getTemplate($_SESSION["jmeno"], $arrPrispevky, $arrRecenze);
    }
}

?>