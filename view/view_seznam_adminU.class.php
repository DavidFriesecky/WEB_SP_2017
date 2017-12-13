<?php

class ViewSAdminU {

    /**
     *  Vytvori stranku se seznamem uzivatelu pro administratora a vrati vysledne HTML
     *  @param string $jmeno jmeno prihlaseneho uzivatele
     *  @param array[][] $arrUsers matice uzivatelu
     *  @return string html vysledneho vzhledu
     */
    public static function getTemplate($jmeno, $arrUsers){
        $res = "<div class='col-sm-1 col-md-2'></div>
                <div class='col-sm-10 col-md-8'>
                    <div class='well well-sm wellUser'>
                    <ul class='nav nav-tabs'>
                        <li class='active'><a data-toggle='tab' href='#menu1'>Administrátoři</a></li>
                        <li><a data-toggle='tab' href='#menu2'>Recenzenti</a></li>
                        <li><a data-toggle='tab' href='#menu3'>Autoři</a></li>
                    </ul>
                    </div>
                    <div class='tab-content'>
                        <div id='menu1' class='tab-pane fade  in active'>
                            <div>
                                <table class='table table-hover'>
                                    <tbody>";

                            foreach ($arrUsers as $indes => $item) {
                                if ($_SESSION["id_uzivatel"] != $item["id_uzivatel"] && $item["id_prava"] == 1) {
                                    $idUser = $item["id_uzivatel"];
                                    if ($item["ban"] == 1) $idBan = 2;
                                    else $idBan = 1;
                                    $jmenoU = $item["jmeno"];
                                    $loginU = $item["login"];
                                    $emailU = $item["email"];
                                    if ($item["ban"] == 1) {
                                        $ban = "success";
                                        $block = "Zablokovat";
                                    }
                                    else {
                                        $ban = "danger";
                                        $block = "Odblokovat";
                                    }

                                    $res .= "<tr class='$ban'>
                                                <td>$jmenoU</td><td>$loginU</td><td>$emailU</td>
                                                <td>
                                                    <div class='dropdown'>
                                                        <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>Nastavení <span class='caret'></span>
                                                        </button>
                                                        <ul class='dropdown-menu'>
                                                            <li><a href='form/settingU.php?id=$idUser&idPrava=2'>Recenzent</a></li>
                                                            <li><a href='form/settingU.php?id=$idUser&idPrava=3'>Autor</a></li>
                                                            <li class='divider'></li>
                                                            <li><a href='form/block.php?id=$idUser&idBan=$idBan'>$block</a></li>
                                                            <li><a href='form/deleteU.php?id=$idUser'>Smazat</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>";
                                }
                            }

        $res .= "</tbody>
                                </table>
                            </div>
                        </div>
                        <div id='menu2' class='tab-pane fade'>
                            <div>
                                <table class='table table-hover'>
                                    <tbody>";

                            foreach ($arrUsers as $indes => $item) {
                                if ($item["id_prava"] == 2) {
                                    $idUser = $item["id_uzivatel"];
                                    if ($item["ban"] == 1) $idBan = 2;
                                    else $idBan = 1;
                                    $jmenoU = $item["jmeno"];
                                    $loginU = $item["login"];
                                    $emailU = $item["email"];
                                    if ($item["ban"] == 1) {
                                        $ban = "success";
                                        $block = "Zablokovat";
                                    }
                                    else {
                                        $ban = "danger";
                                        $block = "Odblokovat";
                                    }

                                    $res .= "<tr class='$ban'>
                                                <td>$jmenoU</td><td>$loginU</td><td>$emailU</td>
                                                <td>
                                                    <div class='dropdown'>
                                                        <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>Nastavení <span class='caret'></span>
                                                        </button>
                                                        <ul class='dropdown-menu'>
                                                            <li><a href='form/settingU.php?id=$idUser&idPrava=1'>Administrátor</a></li>
                                                            <li><a href='form/settingU.php?id=$idUser&idPrava=3'>Autor</a></li>
                                                            <li class='divider'></li>
                                                            <li><a href='form/block.php?id=$idUser&idBan=$idBan'>$block</a></li>
                                                            <li><a href='form/deleteU.php?id=$idUser'>Smazat</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>";
                                }
                            }

        $res .= "</tbody>
                                </table>
                            </div>
                        </div>
                        <div id='menu3' class='tab-pane fade'>
                            <div>
                                <table class='table table-hover'>
                                    <tbody>";

                            foreach ($arrUsers as $indes => $item) {
                                if ($item["id_prava"] == 3) {
                                    $idUser = $item["id_uzivatel"];
                                    if ($item["ban"] == 1) $idBan = 2;
                                    else $idBan = 1;
                                    $jmenoU = $item["jmeno"];
                                    $loginU = $item["login"];
                                    $emailU = $item["email"];
                                    if ($item["ban"] == 1) {
                                        $ban = "success";
                                        $block = "Zablokovat";
                                    }
                                    else {
                                        $ban = "danger";
                                        $block = "Odblokovat";
                                    }

                                    $res .= "<tr class='$ban'>
                                                <td>$jmenoU</td><td>$loginU</td><td>$emailU</td>
                                                <td>
                                                    <div class='dropdown'>
                                                        <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>Nastavení <span class='caret'></span>
                                                        </button>
                                                        <ul class='dropdown-menu'>
                                                            <li><a href='form/settingU.php?id=$idUser&idPrava=1'>Administrátor</a></li>
                                                            <li><a href='form/settingU.php?id=$idUser&idPrava=2'>Recenzent</a></li>
                                                            <li class='divider'></li>
                                                            <li><a href='form/block.php?id=$idUser&idBan=$idBan'>$block</a></li>
                                                            <li><a href='form/deleteU.php?id=$idUser'>Smazat</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>";
                                }
                            }

        $res .= "</tbody>
                                </table>
                            </div>
                        </div>
                    </div>";


        include("view_hlavicky.class.php");
        $viewH = new ViewHlavicky;
        return $viewH->getHTMLStartHeader1("Admin Seznam uživatelů") . $viewH->getImportBS() . $viewH->getHTMLStartHeader2()
                . $viewH->getHTMLAdmin() . $viewH->getHTMLisLoggedOn($jmeno) . $res . $viewH->getHTMLFooter();
    }    
}

?>