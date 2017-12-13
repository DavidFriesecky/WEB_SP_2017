<?php

class ViewLogin {
    
    /**
     *  Vytvori stranku s prihlasenim a vrati vysledne HTML
     *  @param int $bool vypis popisku
     *  @return string html vysledneho vzhledu
     */
    public static function getTemplate($bool) {
        $res = "<div class='col-xs-2 col-sm-3 col-md-4'></div>        
                <div class='well col-xs-8 col-sm-6 col-md-4'>
                    <form method='POST' action='form/login.php'>
                        <div class='form-group'>
                            <label for='login'>Login:</label>
                            <input type='text' class='form-control' name='login'>
                        </div>
                        <div class='form-group'>
                            <label for='heslo'>Heslo:</label>
                            <input type='password' class='form-control' name='heslo'>
                        </div>
                        <div class='form-group'>
                            <input type='hidden' name='action' value='login'>
                            <button type='submit' name='sub' class='btn btn-default btn-block'>Přihlásit</button>
                        </div>
                    </form>";

        if($bool == 0) {
            $res .= "<div class='alert alert-danger fade in'>
                <strong>Error!</strong> Přihlášení se nezdařilo.
            </div>";
        } else if ($bool == 1) {
            $res .= "<div class='alert alert-danger fade in'>
                <strong>Error!</strong> Váš účet byl zablokován.
            </div>";
        }

        $res .= "</div>
                <div class='col-xs-2 col-sm-3 col-md-4'></div>";

        include("view_hlavicky.class.php");
        $viewH = new ViewHlavicky;
        return $viewH->getHTMLStartHeader1("Login") . $viewH->getImportBS() . $viewH->getHTMLStartHeader2()
            . $viewH->getHTMlNull() . $viewH->getHTMLisLoggedOff() . $res . $viewH->getHTMLFooter();
    }    
}

?>