<?php 

class ModUser extends db_pdo {

    /**
     *  Konstruktor
     *  Prihlaseni do databaze
     */
    public function __construct(){
        $this->Connect();
    }

    /**
     *  Vraci data vsech uzivatelu v databazi
     *  @return data vsech uzivatelu
     */
    public function allUsersInfo() {
        $columns = "*";
        $where = array();
        $order_by[0] = array("column" => "id_prava", "sort" => "ASC");
        return $users = $this->DBSelectAll(TABLE_UZIVATELE, $columns, $where, "", $order_by);
    }

    /**
     *  Vraci data vsech recenzentu v databazi
     *  @return data vsech recenzentu
     */
    public function allRecenzentInfo() {
        $columns = "*";
        $where = array();
        $where[] = array("column" => "id_prava", "value" => 2, "symbol" => "=");
        return $users = $this->DBSelectAll(TABLE_UZIVATELE, $columns, $where);
    }

    /**
     *  Prihlaseni uzivatele za urcitiych podminek
     *  @param string $login login uzivatele
     *  @param string $pass heslo uzivatele
     *  @return bool, jestli se podarilo se prihlasit
     */
    public function userLogin($login, $pass){
        if (!$this->isPasswordCorrect($login, $pass)) {
            $_SESSION["incorrectLogin"] = "0";
            return false;
        } else if (!$this->bannedLogin($login)) {
            $_SESSION["bannedLogin"] = "0";
            return false;
        }

        $columns = "*";
        $where = array();
        $where[] = array("column" => "login", "value" => "$login", "symbol" => "=");
        $arr = $this->DBSelectOne(TABLE_UZIVATELE, $columns, $where);
        $_SESSION["id_uzivatel"] = $arr["id_uzivatel"];
        $_SESSION["jmeno"] = $arr["jmeno"];
        $_SESSION["login"] = $arr["login"];
        $_SESSION["heslo"] = $arr["heslo"];
        $_SESSION["email"] = $arr["email"];
        $_SESSION["id_prava"] = $arr["id_prava"];
        print_r($_SESSION["jmeno"]);
        return true;
    }

    /**
     *  Vraci jestli je uzivatel zablokovan
     *  @return bool, blokace uzivatele
     */
    public function bannedLogin($login) {
        $columns = "*";
        $where = array();
        $where[] = array("column" => "login", "value" => "$login", "symbol" => "=");
        $arr = $this->DBSelectOne(TABLE_UZIVATELE, $columns, $where);
        if ($arr["ban"] == 2) return false;
        return true;
    }

    /**
     *  Kontroluje spravnost prihlaseni pomoci loginu a hesla
     *  @param $login login uzivatele
     *  @param $pass heslo uzivatele
     *  @return bool, spravnost hesla
     */
    public function isPasswordCorrect($login, $pass) {
        $columns = "heslo";
        $where = array();
        $where[] = array("column" => "login", "value" => "$login", "symbol" => "=");
        $user = $this->DBSelectOne(TABLE_UZIVATELE, $columns, $where);

        if($user == null) {
            return false;
        }
        return $user["heslo"] == $pass;
    }

    /**
     *  Vraci informace o uzivateli podle loginu
     *  @param $login login uzivatele
     *  @return informace o uzivateli
     */
    public function allUserInfoLogin($login) {
        $columns = "*";
        $where = array();
        $where[] = array("column" => "login", "value" => "$login", "symbol" => "=");
        return $user = $this->DBSelectOne(TABLE_UZIVATELE, $columns, $where);
    }

    /**
     *  Vraci informace o uzivateli podle emailu
     *  @param $email email uzivatele
     *  @return informace o uzivateli
     */
    public function allUserInfoEmail($email) {
        $columns = "*";
        $where = array();
        $where[] = array("column" => "email", "value" => "$email", "symbol" => "=");
        return $user = $this->DBSelectOne(TABLE_UZIVATELE, $columns, $where);
    }

    /**
     *  Kontroluje jestli je uzivatel prihlasen
     */
    public function isUserLogged(){
        return isset($_SESSION["login"]);
    }

    /**
     *  Odhlasi uzivatele
     */
    public function userLogout(){
        session_destroy();
    }

    /**
     *  Registruje uzivatele
     *  @param $name jmeno uzivatele
     *  @param $login login uzivatele
     *  @param $password1 heslo uzivatele
     *  @param $password2 druhe kontrolni heslo uzivatele
     *  @param $email email uzivatele
     *  @return bool, pokud se uzivatele podari zaregistrovat
     */
    public function userRegister($name, $login, $password1, $password2, $email) {
        if ($password1 != $password2) {
            $_SESSION["incorrectRegister"] = "1";
            return false;
        }

        $userIf = $this->allUserInfoLogin($login);
        if ($userIf) {
            $_SESSION["incorrectRegister"] = "2";
            return false;
        }

        $userIf = $this->allUserInfoEmail($email);
        if ($userIf) {
            $_SESSION["incorrectRegister"] = "3";
            return false;
        }

        $id_prava = 3;
        $item = array("jmeno" => $name, "login" => $login, "heslo" => $password1, "email" => $email, "id_prava" => $id_prava);
        $this->DBInsert(TABLE_UZIVATELE, $item);
        return true;
    }

    /**
     *  Upravi prava uzivatele podle jeho ID
     *  @param $userId ID uzivatele
     *  @param $value hodnota pro zmenu prava
     */
    public function updateUserPrava($userId, $value){
        $column[] = array("column" => "id_prava","value" => $value);
        $where = array();
        $where[] = array("column" => "id_uzivatel", "value" => "$userId", "symbol" => "=");
        $this->DBUpdate(TABLE_UZIVATELE, $column, $where);
        return;
    }

    /**
     *  Upravi blokaci uzivatele podle jeho ID
     *  @param $userId ID uzivatele
     *  @param $value hodnota pro zmenu blokace
     */
    public function updateUserBan($userId, $value){
        $column[] = array("column" => "ban","value" => $value);
        $where = array();
        $where[] = array("column" => "id_uzivatel", "value" => "$userId", "symbol" => "=");
        $this->DBUpdate(TABLE_UZIVATELE, $column, $where);
        return;
    }

    /**
     *  Smaze uzivatele podle jeho ID z databaze.
     *  @param int $userId ID uzivatele
     */
    public function deleteUser($userId) {
        $where = array();
        $where[] = array("column" => "id_uzivatel", "value" => "$userId", "symbol" => "=");
        $this->DBDelete(TABLE_UZIVATELE, $where);
        return;
    }
}

?>