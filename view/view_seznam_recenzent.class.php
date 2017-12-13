<?php

class ViewSRecenzent {

    /**
     *  Vytvori stranku se seznamem clanku k recenzi pro recenzenta a vrati vysledne HTML
     *  @param string $jmeno jmeno prihlaseneho uzivatele
     *  @param array[][] $arrRecenze matice recenzi
     *  @return string html vysledneho vzhledu
     */
    public static function getTemplate($jmeno, $arrRecenze){
        $res = "<div class='col-sm-1 col-md-2'></div>
                <div class='col-sm-10 col-md-8'>
                    <div class='panel-group' id='accordion'>";
        $i = 0;
        $stav = "";
        $publikovan = "";

        if (isset($arrRecenze) && $arrRecenze != null) {
            foreach ($arrRecenze as $index1 => $item1) {
                if ($item1["titulekP"] != null && $item1["titulekP"] != "") {
                    $idP = $item1["idP"];
                    $idH = $item1["id_hodnoceni"];
                    $titulek = $item1["titulekP"];
                    $textAutor = $item1["textP"];
                    $dAutor = $item1["datumP"];

                    $dis = null;
                    if ($item1["publikovanP"] == 1) $publikovan = "<span class='label label-default'>V recenzním řízení</span>";
                    else if ($item1["publikovanP"] == 2) {
                        $publikovan = "<span class='label label-success'>Publikován</span>";
                        $dis = "disabled";
                    }
                    else if ($item1["publikovanP"] == 3) {
                        $publikovan = "<span class='label label-danger'>Zamítnut</span>";
                        $dis = "disabled";
                    }

                    if ($item1["text"] != null || $item1["text"] != "") $menu = "<a class='btn btn-primary' href='index.php?page=3&idP=$idP&idH=$idH' $dis>Upravit recenzi</a>";
                    else $menu = "<a class='btn btn-primary' href='index.php?page=3&idP=$idP&idH=$idH' $dis>Napsat recenzi</a>";

                    $res .= "<div class='panel panel-default'>
                                <div class='panel-heading'>
                                    <span>
                                        <h4 class='panel-title'>
                                            <a data-toggle='collapse' data-parent='#accordion' href='#collapse$i'>$titulek</a>
                                        </h4>
                                        <small><i> $dAutor</i></small>
                                        $publikovan
                                    </span>
                                    <div class='btn-group'>
                                       $menu                                           
                                    </div>
                                </div>
                                <div id='collapse$i' class='panel-collapse collapse'>
                                    <div class='panel-body'>$textAutor</div>
                                </div>";
                    $i++;

                    $dRecenzent = $item1["datum"];
                    $textRecenzent = $item1["text"];

                    if ($item1["stav"] == 1) $stav = "<span class='label label-success'>Akceptován</span>";
                    else if ($item1["stav"] == 2) $stav = "<span class='label label-danger'>Zamítnut</span>";

                    if ($item1["stav"] != 0) {
                        $res .= "<div class='media'>
                                <div class='media-left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class='media-body'>
                                    <h4 class='media-heading'><i>$dRecenzent</i><small><i> $stav</i></small></h4>
                                    <div>$textRecenzent</div>
                                </div>
                            </div>";
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
        return $viewH->getHTMLStartHeader1("Recenzent Seznam recenzí") . $viewH->getImportBS() . $viewH->getHTMLStartHeader2()
                . $viewH->getHTMLRecenzent() . $viewH->getHTMLisLoggedOn($jmeno) . $res . $viewH->getHTMLFooter();
    }    
}

?>