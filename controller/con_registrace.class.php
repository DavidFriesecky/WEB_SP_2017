<?php
session_destroy();

class ConRegistrace {
    
    /**
     *  Konstruktor
     *  Pri zavolani se znici session.
     */
    public function __construct(){}

    /**
     *  Vraci stranku s registraci uzivatele
     *  @return html kod stranky
     */
    public function getResult(){
        include("view/view_registrace.class.php");
        if (isset($_SESSION["incorrectRegister"]) && $_SESSION["incorrectRegister"] == "0")
            $html = ViewRegistrace::getTemplate(0);
        else if (isset($_SESSION["incorrectRegister"]) && $_SESSION["incorrectRegister"] == "1")
            $html = ViewRegistrace::getTemplate(1);
        else if (isset($_SESSION["incorrectRegister"]) && $_SESSION["incorrectRegister"] == "2")
            $html = ViewRegistrace::getTemplate(2);
        else if (isset($_SESSION["incorrectRegister"]) && $_SESSION["incorrectRegister"] == "3")
            $html = ViewRegistrace::getTemplate(3);
        else
            $html = ViewRegistrace::getTemplate(4);
        return $html;
    }
}

?>