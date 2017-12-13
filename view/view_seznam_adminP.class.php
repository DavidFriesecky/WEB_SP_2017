<?php

class ViewSAdminP {

    /**
     *  Vytvori stranku se seznamem clanku pro administratora a vrati vysledne HTML
     *  @param string $jmeno jmeno prihlaseneho uzivatele
     *  @param array[][] $arrPrispevky matice clanku
     *  @param array[][] $arrRecenze matice recenzi
     *  @param array[][] $arrRecenzenti matice recenzentu
     *  @param int $id ID prispevku pro pridani recenzentu
     *  @return string html vysledneho vzhledu
     */
    public static function getTemplate($jmeno, $arrPrispevky, $arrRecenze, $arrRecenzenti, $id){
        $res = "<div class='col-sm-1 col-md-2'></div>
                <div class='col-sm-10 col-md-8'>
                    <div class='panel-group' id='accordion'>";
        $i = 0;
        $stav = "";
        $publikovan = "";

        if ($id == null) {
            if (isset($arrPrispevky) && $arrPrispevky != null) {
                foreach ($arrPrispevky as $index1 => $item1) {
                    $idP = $item1["id_prispevky"];
                    $jmenoA = $item1["jmeno"];
                    $loginA = $item1["login"];
                    $titulek = $item1["titulek"];
                    $textAutor = $item1["text"];
                    $datumA = $item1["datum"];

                    if ($item1["publikovan"] == 1) $publikovan = "<span class='label label-default'>V recenzním řízení</span>";
                    else if ($item1["publikovan"] == 2) $publikovan = "<span class='label label-success'>Publikován</span>";
                    else if ($item1["publikovan"] == 3) $publikovan = "<span class='label label-danger'>Zamítnut</span>";

                    $res .= "<div class='panel panel-default'>
                            <div class='panel-heading'>
                                <h4 class='panel-title'>
                                    <a data-toggle='collapse' data-parent='#accordion' href='#collapse$i'>$titulek</a>
                                </h4>
                                <small> $jmenoA / $loginA<i> $datumA</i></small>
                                $publikovan  
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>Nastavení <span class='caret'></span></button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li><a href='index.php?page=6&id=$idP'>Přiřadit recenzenty</a></li>
                                        <li class='divider'></li>
                                        <li><a href='form/settingP.php?id=$idP&idPublic=1'>Do recenzního řízení</a></li>
                                        <li><a href='form/settingP.php?id=$idP&idPublic=2'>Publikovat</a></li>
                                        <li><a href='form/settingP.php?id=$idP&idPublic=3'>Zamítnout</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div id='collapse$i' class='panel-collapse collapse'>
                                <div class='panel-body'>$textAutor</div>
                            </div>";
                    $i++;

                    if (isset($arrRecenze) && $arrRecenze != null) {
                        foreach ($arrRecenze as $index2 => $item2) {
                            if ($item1["id_prispevky"] == $item2["id_prispevky"]) {
                                $jmenoR = $item2["jmeno"];
                                $loginR = $item2["login"];
                                $datumR = $item2["datum"];
                                $textRecenzent = $item2["text"];

                                if ($item2["stav"] == 0) $stav = "<span class='label label-default'>Nevyřízeno</span>";
                                else if ($item2["stav"] == 1) $stav = "<span class='label label-success'>Akceptován</span>";
                                else if ($item2["stav"] == 2) $stav = "<span class='label label-danger'>Zamítnut</span>";

                                $res .= "<div class='media'>
                                        <div class='media-left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                        <div class='media-body'>
                                            <h5 class='media-heading'>$jmenoR / $loginR<i><small> $datumR </small>$stav</i></h5>
                                            <div>$textRecenzent</div>
                                        </div>
                                    </div>";
                            }
                        }
                    }

                    $res .= "</div>";
                }

                $res .= "</div></div>";
            } else {
                $res = "<div class='col-sm-1 col-md-2'></div>
                <div class='col-sm-10 col-md-8'><p>Nemáte žádné přidané příspěvky.</p></div>";

            }
        } else {
            $res .="<form method='POST' action='form/addUsers.php?id=$id'>
                        <table class='table table-striped'>
                            <tbody>
                                <tr>
                                    <th></th><th>Jméno</th><th>Login</th>
                                </tr>";

                        foreach ($arrRecenzenti as $index1 => $item1) {
                            $b = 0;
                            foreach ($arrRecenze as $index2 => $item2) {
                                if ($item1["id_uzivatel"] == $item2["id_uzivatel"] && $item2["id_prispevky"] == $id) {
                                    $b = 1;
                                    break;
                                }
                            }

                            if ($b == 0) {
                                $idUser = $item1["id_uzivatel"];
                                $jmenoU = $item1["jmeno"];
                                $loginU = $item1["login"];
                                if ($item1["ban"] == 1) $ban = "success";
                                else $ban = "danger";

                                $res .= "<tr class='$ban'>
                                        <td>
                                            <input type='hidden' name='id$idUser' value='false'>
                                            <input type='checkbox' name='id$idUser' value='true'>
                                        </td>
                                        <td>$jmenoU</td>
                                        <td>$loginU</td>
                                    </tr>";
                            }
                        }

            $res .= "</tbody></table>
                        <input class='btn btn-success btn-block' type='submit' value='Uložit'>
                     </form></div></div>";
        }


        include("view_hlavicky.class.php");
        $viewH = new ViewHlavicky;
        return $viewH->getHTMLStartHeader1("Admin Seznam článků") . $viewH->getImportBS() . $viewH->getHTMLStartHeader2()
                . $viewH->getHTMLAdmin() . $viewH->getHTMLisLoggedOn($jmeno) . $res . $viewH->getHTMLFooter();
    }    
}

?>