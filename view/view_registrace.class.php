<?php

class ViewRegistrace {

    /**
     *  Vytvori stranku registraci a vrati vysledne HTML
     *  @param int $bool vypis popisku
     *  @return string html vysledneho vzhledu
     */
    public static function getTemplate($bool) {
        $res = "<div class='col-xs-2 col-sm-3 col-md-4'></div>        
                <div class='well col-xs-8 col-sm-6 col-md-4'>
                    <form method='POST' action='form/registrace.php'>
                        <div class='form-group'>
                            <label for='jmeno'>Jméno:</label>
                            <input type='text' class='form-control' name='jmeno'>
                        </div>
                        <div class='form-group'>
                            <label for='email'>Email:</label>
                            <input type='email' class='form-control' name='email'>
                        </div>
                        <div class='form-group'>
                            <label for='login'>Login:</label>
                            <input type='text' class='form-control' name='login'>
                        </div>
                        <div class='form-group'>
                            <label for='heslo1'>Heslo:</label>
                            <input type='password' class='form-control' name='heslo1'>
                        </div>
                        <div class='form-group'>
                            <label for='heslo2'>Kontrola hesla:</label>
                            <input type='password' class='form-control' name='heslo2'>
                        </div>
                        <div class='form-group'>
                            <input type='hidden' name='action' value='register'>
                            <button type='submit' name='sub' class='btn btn-default btn-block'>Registrovat</button>
                        </div>
                    </form>";

        if($bool == 0) {
            $res .= "<div class='form-group'>
                        <div class='alert alert-danger fade in'>
                            <strong>Error!</strong> Nebyl vyplněn celý formulář.
                        </div>
                     </div>";
        }

        if($bool == 1) {
            $res .= "<div class='form-group'>
                        <div class='alert alert-danger fade in'>
                            <strong>Error!</strong> Zadejte stejná hesla.
                        </div>
                     </div>";
        }

        if($bool == 2) {
            $res .= "<div class='form-group'>
                        <div class='alert alert-danger fade in'>
                            <strong>Error!</strong> Zadali jste již používaný login.
                        </div>
                     </div>";
        }

        if($bool == 3) {
            $res .= "<div class='form-group'>
                        <div class='alert alert-danger fade in'>
                            <strong>Error!</strong> Zadali jste již používaný email.
                        </div>
                     </div>";
        }

        $res .= "</div>
                <div class='col-xs-2 col-sm-3 col-md-4'></div>";

        include("view_hlavicky.class.php");
        $viewH = new ViewHlavicky;

        return $viewH->getHTMLStartHeader1("Registrace") . $viewH->getImportBS() . $viewH->getHTMLStartHeader2()
            . $viewH->getHTMlNull() . $viewH->getHTMLisLoggedOff() . $res . $viewH->getHTMLFooter();
    }
}

?>