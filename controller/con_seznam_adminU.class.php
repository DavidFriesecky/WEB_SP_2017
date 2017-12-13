<?php

include_once("model/mod_db.class.php");
include_once("model/mod_user.class.php");
include_once("model/settings.inc.php");
include_once("model/functions.inc.php");

class ConSAdminU {
    /**
     *  Konstruktor
     */
    public function __construct(){

    }

    /**
     *  Vraci stranku se seznamem uzivatelu pro administratora
     *  @return html kod stranky
     */
    public function getResult(){
        $user = new ModUser;
        include("view/view_seznam_adminU.class.php");
        $viewSAdminU = new ViewSAdminU;

        $arrUsers = $user->allUsersInfo();

        return $viewSAdminU->getTemplate($_SESSION["jmeno"], $arrUsers);
    }
}

?>