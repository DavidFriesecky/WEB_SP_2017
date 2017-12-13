<?php
session_destroy();

class ConLogin {

    /**
     *  Konstruktor
     *  pri zavolani se znici session
     */
    public function __construct(){}

    /**
     *  Vraci stranku s prihlasenim uzivatele
     *  @return html kod stranky
     */
    public function getResult(){
        include("view/view_login.class.php");
        if (isset($_SESSION["incorrectLogin"])) $html = ViewLogin::getTemplate(0);
        elseif (isset($_SESSION["bannedLogin"])) $html = ViewLogin::getTemplate(1);
        else $html = ViewLogin::getTemplate(2);
        return $html;
    }
}

?>