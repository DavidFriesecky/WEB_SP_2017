<?php

class ViewUvod {

    /**
     *  Vytvori stranku se seznamem clanku pro administratora a vrati vysledne HTML
     *  @param int $isLogged zda je uzivatel prihlasen
     *  @param string $jmeno jmeno prihlaseneho uzivatele
     *  @param int $isPrava prava prihlaseneho uzivatele
     *  @param array[][] $arrPrispevky matice clanku
     *  @return string html vysledneho vzhledu
     */
    public static function getTemplate($isLogged, $jmeno, $id_prava, $arrPrispevky){
        $res = "<div class='col-sm-1 col-md-2'></div>
                <div class='col-sm-10 col-md-8'>
                    <div class='panel-group' id='accordion'>";
        $i = 0;

        if (isset($arrPrispevky) && $arrPrispevky != null) {
            foreach ($arrPrispevky as $index => $item) {
                if ($item["publikovan"] == 2) {
                    $titulek = $item["titulek"];
                    $jmenoP = $item["jmeno"];
                    $text = $item["text"];
                    $datum = $item["datum"];

                    $res .= "<div class='panel panel-default'>
                            <div class='panel-heading'>
                                <span>
                                    <h4 class='panel-title'>
                                        <a data-toggle='collapse' data-parent='#accordion' href='#collapse$i'>$titulek</a>
                                    </h4>
                                    <small>$jmenoP<i> $datum</i></small>
                                </span>
                            </div>
                            <div id='collapse$i' class='panel-collapse collapse'>
                                <div class='panel-body'>$text</div>
                            </div>";
                    $i++;

                    $res .= "</div>";
                }
            }
            $res .= "</div></div>";
        } else {
            $res = "<div class='col-sm-1 col-md-2'></div>
                <div class='col-sm-10 col-md-8'><p>Na stránce nejsou žádné přidané příspěvky.</p></div>";

        }
        include("view_hlavicky.class.php");
        $viewH = new ViewHlavicky;

        if (!$isLogged) {
            return $viewH->getHTMLStartHeader1("Úvodní stránka") . $viewH->getImportBS() . $viewH->getHTMLStartHeader2()
                . $viewH->getHTMLNull() . $viewH->getHTMLisLoggedOff() . $res . $viewH->getHTMLFooter();
        } elseif ($id_prava == 1) {
            return $viewH->getHTMLStartHeader1("Úvodní stránka") . $viewH->getImportBS() . $viewH->getHTMLStartHeader2()
                . $viewH->getHTMLAdmin() . $viewH->getHTMLisLoggedOn($jmeno) . $res . $viewH->getHTMLFooter();
        } elseif ($id_prava == 2) {
            return $viewH->getHTMLStartHeader1("Úvodní stránka") . $viewH->getImportBS() . $viewH->getHTMLStartHeader2()
                . $viewH->getHTMLRecenzent() . $viewH->getHTMLisLoggedOn($jmeno) . $res . $viewH->getHTMLFooter();
        } else {
            return $viewH->getHTMLStartHeader1("Úvodní stránka") . $viewH->getImportBS() . $viewH->getHTMLStartHeader2()
                . $viewH->getHTMLAutor() . $viewH->getHTMLisLoggedOn($jmeno) . $res . $viewH->getHTMLFooter();
        }
    }    
}

?>