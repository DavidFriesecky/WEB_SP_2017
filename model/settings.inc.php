<?php

// Prihlasovaci udaje do databaze
define("DB_SERVER", "students.kiv.zcu.cz");
define("DB_DATABASE_NAME", "db1_vyuka");
define("DB_USER_LOGIN", "db1_vyuka");
define("DB_USER_PASSWORD", "db1_vyuka");

// Nazvy tabulek
$username = "frieseck";
define("TABLE_UZIVATELE", $username."_uzivatele");
define("TABLE_PRAVA", $username."_prava");
define("TABLE_HODNOCENI", $username."_hodnoceni");
define("TABLE_PRISPEVKY", $username."_prispevky");

// Stranky pouzivane na webu (ostatni nebudou dostupne)
$web_pagesExtension = ".class.php";
$web_file = "controller/";
$web_pages[0] = "con_uvod";
$web_pages[1] = "con_login";
$web_pages[2] = "con_registrace";
$web_pages[3] = "con_novy_ck";
$web_pages[4] = "con_seznam_autor";
$web_pages[5] = "con_seznam_recenzent";
$web_pages[6] = "con_seznam_adminP";
$web_pages[7] = "con_seznam_adminU";

$web_classes[0] = "ConUvod";
$web_classes[1] = "ConLogin";
$web_classes[2] = "ConRegistrace";
$web_classes[3] = "ConNovyCK";
$web_classes[4] = "ConSAutor";
$web_classes[5] = "ConSRecenzent";
$web_classes[6] = "ConSAdminP";
$web_classes[7] = "ConSAdminU";
?>