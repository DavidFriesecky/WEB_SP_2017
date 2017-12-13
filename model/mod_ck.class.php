<?php

class ModCK extends db_pdo {

    /**
     *  Konstruktor
     *  Pripojeni k databazi
     */
    public function __construct(){
        $this->Connect();
    }

    /**
     *  Vraci data prispevku podle jeho ID
     *  @param int $id_prispevky ID prispevku
     *  @return data jednoho vybraneho prispevku
     */
    public function prispevekInfoID($id_prispevky) {
        $columns = "*";
        $where = array();
        $where[] = array("column" => "id_prispevky", "value" => "$id_prispevky", "symbol" => "=");
        return $prispevek = $this->DBSelectOne(TABLE_PRISPEVKY, $columns, $where);
    }

    /**
     *  Vraci data recenze podle jejiho ID
     *  @param int $id_hodnoceni ID hodnoceni
     *  @return data jedne vybrane recenze
     */
    public function recenzeInfoID($id_hodnoceni) {
        $columns = "*";
        $where = array();
        $where[] = array("column" => "id_hodnoceni", "value" => "$id_hodnoceni", "symbol" => "=");
        return $recenze = $this->DBSelectOne(TABLE_HODNOCENI, $columns, $where);
    }

    /**
     *  Vraci data prispevku podle jeho titulku
     *  @param string $titulek titulek
     *  @return data jednoho vybraneho prispevku
     */
    public function prispevkyInfoTit($titulek) {
        $columns = "*";
        $where = array();
        $where[] = array("column" => "titulek", "value" => "$titulek", "symbol" => "=");
        return $prispevek = $this->DBSelectOne(TABLE_PRISPEVKY, $columns, $where);
    }

    /**
     *  Vraci data vsech prispevku podle prihlaseneho autora
     *  @return data vsech prispevku patrici autorovi
     */
    public function allPrispevkyInfoA() {
        $columns = "*";
        $where = array();
        $where[] = array("column" => "id_uzivatel", "value" => $_SESSION["id_uzivatel"], "symbol" => "=");
        $order_by[0] = array("column" => "datum", "sort" => "DESC");
        return $prispevky = $this->DBSelectAll(TABLE_PRISPEVKY, $columns, $where, "", $order_by);
    }

    /**
     *  Vraci vsechny recenze se jmenem recenzenta vazajici se k prispevkum prihlaseneho autora
     *  @return data vsech vybranych recenzi vztahujicich se k prispevkum prihlaseneho autora
     */
    public function allRecenzeInfoA() {
        $prispevky = $this->allPrispevkyInfoA();

        $columns = "*";
        $where = array();
        $recenze = $this->DBSelectAll(TABLE_HODNOCENI, $columns, $where);
        $i = 0;

        $recenzeX = array();
        foreach ($prispevky as $index1 => $hodnota1) {
            foreach ($recenze as $index2 => $hodnota2) {
                if ($hodnota1["id_prispevky"] == $hodnota2["id_prispevky"]) {
                    $recenzeX[$i] = $recenze[$index2];
                    $i++;
                }
            }
        }

        $i = 0;
        foreach ($recenzeX as $index => $hodnota) {
            $columns = "jmeno";
            $where = array();
            $where[] = array("column" => "id_uzivatel", "value" => $hodnota["id_uzivatel"], "symbol" => "=");
            $arr = $this->DBSelectOne(TABLE_UZIVATELE, $columns, $where);
            if (isset($arr) && $arr != null) {
                $recenzeX[$index]["jmeno"] = $arr["jmeno"];
                $i++;
            }
        }
        return $recenzeX;
    }

    /**
     *  Vraci data vsech prispevku
     *  @return data vsech prispevku
     */
    public function allPrispevkyInfo() {
        $columns = "*";
        $where = array();
        $order_by[0] = array("column" => "datum", "sort" => "DESC");
        return $prispevky = $this->DBSelectAll(TABLE_PRISPEVKY, $columns, $where, "", $order_by);
    }

    /**
     *  Vraci data vsech recenzi
     *  @return data vsech recenzi
     */
    public function allRecenzeInfo() {
        $columns = "*";
        $where = array();
        $order_by[0] = array("column" => "datum", "sort" => "DESC");
        return $recenze = $this->DBSelectAll(TABLE_HODNOCENI, $columns, $where, "", $order_by);
    }

    /**
     *  Vraci data vsech prispevku se jmenem a loginem autora
     *  @return data vsech prispevku se jmenem a loginem autora
     */
    public function allPrispevkyUserInfo() {
        $prispevky = $this->allPrispevkyInfo();
        $i = 0;
        foreach ($prispevky as $index => $hodnota) {
            $columns = "jmeno, login";
            $where = array();
            $where[] = array("column" => "id_uzivatel", "value" => $hodnota["id_uzivatel"], "symbol" => "=");
            $arr = $this->DBSelectOne(TABLE_UZIVATELE, $columns, $where);
            if (isset($arr) && $arr != null) {
                $prispevky[$index]["jmeno"] = $arr["jmeno"];
                $prispevky[$index]["login"] = $arr["login"];
                $i++;
            }
        }
        return $prispevky;
    }

    /**
     *  Vraci data vsech recenzi se jmenem a loginem recenzenta
     *  @return data vsech recenzi se jmenem a loginem recenzenta
     */
    public function allRecenzeUserInfo() {
        $recenze = $this->allRecenzeInfo();
        $i = 0;
        foreach ($recenze as $index => $hodnota) {
            $columns = "jmeno, login";
            $where = array();
            $where[] = array("column" => "id_uzivatel", "value" => $hodnota["id_uzivatel"], "symbol" => "=");
            $arr = $this->DBSelectOne(TABLE_UZIVATELE, $columns, $where);
            if (isset($arr) && $arr != null) {
                $recenze[$index]["jmeno"] = $arr["jmeno"];
                $recenze[$index]["login"] = $arr["login"];
                $i++;
            }
        }
        return $recenze;
    }

    /**
     *  Vraci data vsech recenzi vazajici se k recenzentovi spolu s pridelenymi prispevky
     *  @return data vsech recenzi spolu s pridelenymi prispevky prihlaseneho recenzenta
     */
    public function allRecenzeInfoR() {
        $columns = "*";
        $where = array();
        $where[] = array("column" => "id_uzivatel", "value" => $_SESSION["id_uzivatel"], "symbol" => "=");
        $recenze = $this->DBSelectAll(TABLE_HODNOCENI, $columns, $where);

        $prispevky = $this->allPrispevkyInfo();

        $recenzeX = array();
        $i = 0;
        foreach ($prispevky as $index1 => $hodnota1) {
            foreach ($recenze as $index2 => $hodnota2) {
                if ($hodnota1["id_prispevky"] == $hodnota2["id_prispevky"]) {
                    $recenzeX[$i] = $recenze[$index1];
                    $recenzeX[$i]["idP"] = $hodnota1["id_prispevky"];
                    $recenzeX[$i]["titulekP"] = $hodnota1["titulek"];
                    $recenzeX[$i]["textP"] = $hodnota1["text"];
                    $recenzeX[$i]["datumP"] = $hodnota1["datum"];
                    $recenzeX[$i]["publikovanP"] = $hodnota1["publikovan"];
                    $i++;
                }
            }
        }
        return $recenzeX;
    }

    /**
     *  Vraci jedinecny titulek pokud se s nejakym shoduje v databazi
     *  @return data vsech recenzi spolu s pridelenymi prispevky prihlaseneho recenzenta
     */
    public function correctTitle($titulek) {
        if (!isset($titulek) || $titulek == "") {
            $x = 1;
            do {
                $titulek = $_SESSION["jmeno"] . " ($x)";
                $prispevek = $this->prispevkyInfoTit($titulek);
                $x++;
            } while ($prispevek);

            return $titulek;
        }

        $prispevek = $this->prispevkyInfoTit($titulek);
        if ($prispevek) {
            $x = 1;
            do {
                $titulek .= " ($x)";
                $prispevek = $this->prispevkyInfoTit($titulek);
                $x++;
            } while ($prispevek);
        }

        return $titulek;
    }

    /**
     *  Vlozi data recenze do databaze
     *  @param string $text text recenze
     *  @param int $stav stav
     *  @param int $id_hodnoceni ID recenze
     *  @return bool, jestli se podarilo data pridat
     */
    public function insertTextRecenzent($text, $stav, $id_hodnoceni) {
        if (!isset($text) || $text == "")
            return false;

        $column[] = array("column" => "text","value" => $text);
        $where = array();
        $where[] = array("column" => "id_hodnoceni", "value" => "$id_hodnoceni", "symbol" => "=");
        $this->DBUpdate(TABLE_HODNOCENI, $column, $where);

        $datum = Date("Y-m-d", Time());
        $column[] = array("column" => "datum","value" => $datum);
        $where = array();
        $where[] = array("column" => "id_hodnoceni", "value" => "$id_hodnoceni", "symbol" => "=");
        $this->DBUpdate(TABLE_HODNOCENI, $column, $where);

        $column[] = array("column" => "stav","value" => $stav);
        $where = array();
        $where[] = array("column" => "id_hodnoceni", "value" => "$id_hodnoceni", "symbol" => "=");
        $this->DBUpdate(TABLE_HODNOCENI, $column, $where);
        return true;
    }

    /**
     *  Vlozi data prispevku do databaze
     *  @param string $titulek titulek
     *  @param string $text text prispevku
     *  @return bool, jestli se podarilo data pridat
     */
    public function insertTextAutor($titulek, $text) {
        if (!isset($text) || $text == "")
            return false;

        $correct = $this->correctTitle($titulek);
        $datum = Date("Y-m-d", Time());
        $publikovan = 1;
        $id_uzivatel = $_SESSION["id_uzivatel"];

        $item = array("titulek" => $correct, "text" => $text, "datum" => $datum, "publikovan" => $publikovan, "id_uzivatel" => $id_uzivatel);
        $this->DBInsert(TABLE_PRISPEVKY, $item);
        return true;
    }

    /**
     *  Upravi data prispevku v databazi
     *  @param int $id ID prispevku
     *  @param string $titulek titulek
     *  @param string $text text prispevku
     *  @return bool, jestli se podarilo data pridat
     */
    public function updatePrispevkyText($id, $titulek, $text) {
        if (!isset($text) || $text == "")
            return false;

        $correctTit = $this->correctTitle($titulek);
        $column[] = array("column" => "titulek","value" => $correctTit);
        $where = array();
        $where[] = array("column" => "id_prispevky", "value" => "$id", "symbol" => "=");
        $this->DBUpdate(TABLE_PRISPEVKY, $column, $where);

        $column[] = array("column" => "text","value" => $text);
        $where = array();
        $where[] = array("column" => "id_prispevky", "value" => "$id", "symbol" => "=");
        $this->DBUpdate(TABLE_PRISPEVKY, $column, $where);

        $datum = Date("Y-m-d", Time());
        $column[] = array("column" => "datum","value" => $datum);
        $where = array();
        $where[] = array("column" => "id_prispevky", "value" => "$id", "symbol" => "=");
        $this->DBUpdate(TABLE_PRISPEVKY, $column, $where);

        $publikovan = 1;
        $column[] = array("column" => "publikovan","value" => $publikovan);
        $where = array();
        $where[] = array("column" => "id_prispevky", "value" => "$id", "symbol" => "=");
        $this->DBUpdate(TABLE_PRISPEVKY, $column, $where);
        return true;
    }

    /**
     *  Upravi publikaci prispevku v databazi
     *  @param int $id ID prispevku
     *  @param int $value hodnota ke zmene publikace
     */
    public function updatePrispevkyPublic($id, $value) {
        $column[] = array("column" => "publikovan","value" => $value);
        $where = array();
        $where[] = array("column" => "id_prispevky", "value" => "$id", "symbol" => "=");
        $this->DBUpdate(TABLE_PRISPEVKY, $column, $where);
        return;
    }

    /**
     *  Smaze prispevek podle ID z databaze
     *  @param int $id ID prispevku
     */
    public function deletePrispevek($idP) {
        $this->deleteHodnoceniByIdP($idP);

        $where = array();
        $where[] = array("column" => "id_prispevky", "value" => "$idP", "symbol" => "=");
        $this->DBDelete(TABLE_PRISPEVKY, $where);
        return;
    }

    /**
     *  Smaze recenze podle ID prispevku
     *  @param int $id ID prispevku
     */
    public function deleteHodnoceniByIdP($idP) {
        $where = array();
        $where[] = array("column" => "id_prispevky", "value" => "$idP", "symbol" => "=");
        $this->DBDelete(TABLE_HODNOCENI, $where);
        return;
    }

    /**
     *  Smaze prispevky podle ID uzivatele
     *  @param int $id ID uzivatele
     */
    public function deletePrispevkyByIdU($idU) {
        $where = array();
        $where[] = array("column" => "id_uzivatel", "value" => "$idU", "symbol" => "=");
        $this->DBDelete(TABLE_PRISPEVKY, $where);
        return;
    }

    /**
     *  Smaze recenze podle ID uzivatele
     *  @param int $id ID uzivatele
     */
    public function deleteHodnoceniByIdU($idU) {
        $where = array();
        $where[] = array("column" => "id_uzivatel", "value" => "$idU", "symbol" => "=");
        $this->DBDelete(TABLE_HODNOCENI, $where);
        return;
    }
}

?>