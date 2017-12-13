<?php

class ViewHlavicky {

    /**
     *  Vrati html prvni casti hlavicky stranky
     *  @param $title titulek stranky
     */
    public static function getHTMLStartHeader1($title){
        return "<!doctype html>
                <html lang='cs'>
					<head>
						<meta charset='utf-8'><title>$title</title>";
    }

    /**
     *  Vrati html druhe casti hlavicky stranky
     */
    public static function getHTMLStartHeader2(){
        return "</head>
                <body>
                    <nav class='navbar navbar-inverse navbar-fixed-top'>
                        <div class='container-fluid'>
                            <div class='navbar-header'>
                                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                                    <span class='icon-bar'></span>
                                    <span class='icon-bar'></span>
                                    <span class='icon-bar'></span>
                                </button>
                            </div>
                        <div class='collapse navbar-collapse' id='myNavbar'>
                        <ul class='nav navbar-nav navbar-left'>
                            <li><a class='navbar-brand' href='index.php?page=0'>Konference</a></li>";
    }

    /**
     *  Vrati importy bootstrapu a css
     */
    public static function getImportBS() {
        return "<!-- Latest compiled and minified CSS -->
                <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

                <!-- jQuery library -->
                <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

                <!-- Latest compiled JavaScript -->
                <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
                
                <link rel='stylesheet' type='text/css' href='css/main.css'>";
    }

    /**
     *  Vrati import CK editoru
     */
    public static function getImportCKE() {
        return "<script src='ckeditor/ckeditor.js'></script>";
    }

    /**
     *  Vrati html volby v hlavicce kdy uzivatel neni prihlasen
     */
    public static function getHTMLNull(){
        return 	"<li><a href='index.php?page=0'>Úvod</a></li>";
    }

    /**
     *  Vrati html volby v hlavicce kdy uzivatel jako admin
     */
    public static function getHTMLAdmin(){
        return 	"<li><a href='index.php?page=0'>Úvod</a></li>
                 <li><a href='index.php?page=6'>Seznam článků</a></li>
                 <li><a href='index.php?page=7'>Seznam uživatelů</a></li>";
    }

    /**
     *  Vrati html volby v hlavicce kdy uzivatel jako recenzent
     */
    public static function getHTMLRecenzent(){
        return 	"<li><a href='index.php?page=0'>Úvod</a></li>
                 <li><a href='index.php?page=5'>Seznam přidělených článků</a></li>";
    }

    /**
     *  Vrati html volby v hlavicce kdy uzivatel jako autor
     */
    public static function getHTMLAutor(){
        return "<li><a href='index.php?page=0'>Úvod</a></li>
                <li><a href='index.php?page=3'>Nový článek</a></li>
                <li><a href='index.php?page=4'>Seznam článků</a></li>";
    }

    /**
     *  Vrati html volby v hlavicce s prihlasenim
     */
    public static function getHTMLisLoggedOff(){
        return 	"</ul>
                            <ul class='nav navbar-nav navbar-right'>
                                <li><a href='index.php?page=1'>Login</a></li>
                                <li><a href='index.php?page=2'>Registrace</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class='jumbotron'></div>";
    }

    /**
     *  Vrati html volby v hlavicce kdy uzivatel je prihlasen
     */
    public static function getHTMLisLoggedOn($jmeno){
        return "</ul>
                            <ul class='nav navbar-nav navbar-right'>
                                <li class='dropdown'>
                                    <a class='dropdown-toggle' data-toggle='dropdown'>$jmeno&nbsp&nbsp<span class='caret'></span></a>
                                    <ul class='dropdown-menu'>
                                        <li><a href='form/logout.php'>Odhlásit</a></li>                                      
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class='jumbotron'></div>";
    }

    /**
     *  Vrati paticku stranky
     */
    public static function getHTMLFooter(){
        return 	"</body>
                </html>";
    }
}

?>