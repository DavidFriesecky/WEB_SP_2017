<?php

class ViewSAutor {

    /**
     *  Vytvori stranku se seznamem clanku pro autora a vrati vysledne HTML
     *  @param string $jmeno jmeno prihlaseneho uzivatele
     *  @param array[][] $arrPrispevky matice clanku
     *  @param array[][] $arrRecenze matice recenzi
     *  @return string html vysledneho vzhledu
     */
    public static function getTemplate($jmeno, $arrPrispevky, $arrRecenze){
        $res = "<div class='col-sm-1 col-md-2'></div>
                <div class='col-sm-10 col-md-8'>
                    <div class='panel-group' id='accordion'>";
        $i = 0;
        $stav = "";
        $publikovan = "";

        if (isset($arrPrispevky) && $arrPrispevky != null) {
            foreach ($arrPrispevky as $index1 => $item1) {
                if ($item1["titulek"] != null && $item1["titulek"] != "") {
                    $idP = $item1["id_prispevky"];
                    $titulek = $item1["titulek"];
                    $textAutor = $item1["text"];
                    $dAutor = $item1["datum"];

                    if ($item1["publikovan"] == 1) $publikovan = "<span class='label label-default'>V recenzním řízení</span>";
                    else if ($item1["publikovan"] == 2) $publikovan = "<span class='label label-success'>Publikován</span>";
                    else if ($item1["publikovan"] == 3) $publikovan = "<span class='label label-danger'>Zamítnut</span>";

                    $res .= "<div class='panel panel-default'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'>
                                        <a data-toggle='collapse' data-parent='#accordion' href='#collapse$i'>$titulek</a>
                                    </h4>
                                    <small><i> $dAutor</i></small>
                                    $publikovan  
                                    <div class='btn-group'>
                                        <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>Nastavení <span class='caret'></span></button>
                                        <ul class='dropdown-menu' role='menu'>
                                            <li><a href='form/editP.php?id=$idP'>Upravit</a></li>
                                            <li><a href='form/deleteP.php?id=$idP'>Smazat</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div id='collapse$i' class='panel-collapse collapse'>
                                    <div class='panel-body'>$textAutor</div>
                                </div>";
                    $i++;

                    if (isset($arrRecenze) && $arrRecenze != null) {
                        foreach ($arrRecenze as $index2 => $item2) {
                            if ($item2["stav"] != 0 && $item1["id_prispevky"] == $item2["id_prispevky"]) {
                                $name = $item2["jmeno"];
                                $dRecenzent = $item2["datum"];
                                $textRecenzent = $item2["text"];

                                if ($item2["stav"] == 1) $stav = "<span class='label label-success'>Akceptován</span>";
                                else if ($item2["stav"] == 2) $stav = "<span class='label label-danger'>Zamítnut</span>";

                                $res .= "<div class='media'>
                                            <div class='media-left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                            <div class='media-body'>
                                                <h4 class='media-heading'>$name<small><i> $dRecenzent $stav</i></small></h4>
                                                <div>$textRecenzent</div>
                                            </div>
                                        </div>";
                            }
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

        include("view_hlavicky.class.php");
        $viewH = new ViewHlavicky;
        return $viewH->getHTMLStartHeader1("Autor Seznam článků") . $viewH->getImportBS() . $viewH->getHTMLStartHeader2()
                . $viewH->getHTMLAutor() . $viewH->getHTMLisLoggedOn($jmeno) . $res . $viewH->getHTMLFooter();
    }    
}

?>