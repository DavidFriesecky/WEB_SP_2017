<?php

class ViewNovyCK {

    /**
     *  Vytvori stranku s CK editorem a vrati vysledne HTML
     *  @param string $jmeno jmeno prihlaseneho uzivatele
     *  @param int $id_prava prava prave prihlaseneho uzivatele
     *  @param string $title titulek clanku
     *  @param string $textP text clanku
     *  @param string $textH text recenze
     *  @param int $edit zda se jedna o upravu
     *  @param int $id clanku nebo recenze (podle uzivatele)
     *  @return string html vysledneho vzhledu
     */
    public static function getTemplate($jmeno, $id_prava, $title, $textP, $textH, $edit, $id){
        if ($id_prava == 2) {
            $res = "<div class='col-sm-1 col-md-2'></div>
                    <div class='col-sm-10 col-md-8'>
                        <form method='POST' action='form/novyCK.php?id=$id'>
                            <div class='panel-group' id='accordion'>
                                <div class='panel panel-default'>
                                    <div class='panel-heading'>
                                        <h4 class='panel-title'>
                                            <a data-toggle='collapse' data-parent='#accordion' href='#collapse1'><h4>Recenze: $title</h4></a>
                                            <div class='form-group'>
                                                <select class='form-control' id='sel1' name='stav'>
                                                    <option value='1'>Akceptovat</option>
                                                    <option value='2'>Zamítnout</option>
                                                </select>
                                            </div>
                                        </h4>
                                    </div>
                                    <div id='collapse1' class='panel-collapse collapse'>
                                        <div class='panel-body'>$textP</div>
                                    </div>
                                </div>
                            </div>
                    
                        
                            <div class='form-group'>
                                <textarea name='editor1' id='editor1' rows='10' cols='80'>$textH</textarea>
                                <script>
                                    // Replace the <textarea id='editor1'> with a CKEditor
                                    // instance, using default configuration.
                                    CKEDITOR.replace( 'editor1' );
                                </script>
                            </div>
                            <div class='form-group'>
                                <input type='hidden' name='action' value='novyCK'>
                                <button type='submit' name='sub' class='btn btn-default btn-primary'>Uložit</button>
                            </div>
                        </form>
                    </div>
                    <div class='col-sm-1 col-md-2'></div>";

        } else {
            $res = "<div class='col-sm-1 col-md-2'></div>        
                <div class='col-sm-10 col-md-8'>
                    <form method='POST' action='form/novyCK.php?edit=$edit&id=$id'>
                        <div class='form-group'>
                            <label for='titulek'>Titulek:</label>
                            <input type='text' class='form-control' name='titulek' id='titulek' value='$title'>
                        </div>
                        <div class='form-group'>
                            <textarea name='editor1' id='editor1' rows='10' cols='80'>$textP</textarea>
                            <script>
                                // Replace the <textarea id='editor1'> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'editor1' );
                            </script>
                        </div>
                        <div class='form-group'>
                            <input type='hidden' name='action' value='novyCK'>
                            <button type='submit' name='sub' class='btn btn-default btn-primary'>Uložit</button>
                        </div>
                    </form>
                </div>
                <div class='col-sm-1 col-md-2'></div>";
        }

        include("view_hlavicky.class.php");
        $viewH = new ViewHlavicky;

        if ($id_prava == 2)
            return $viewH->getHTMLStartHeader1("Nová recenze") . $viewH->getImportBS() . $viewH->getImportCKE() . $viewH->getHTMLStartHeader2()
                . $viewH->getHTMLRecenzent() . $viewH->getHTMLisLoggedOn($jmeno) . $res . $viewH->getHTMLFooter();
        else
            return $viewH->getHTMLStartHeader1("Nový článek") . $viewH->getImportBS() . $viewH->getImportCKE() . $viewH->getHTMLStartHeader2()
                . $viewH->getHTMLAutor() . $viewH->getHTMLisLoggedOn($jmeno) . $res . $viewH->getHTMLFooter();
    }    
}

?>