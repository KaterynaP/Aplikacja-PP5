<?php
require_once("db.php");

class User extends  Db{

    public function userVerification($user, $pass){

        $dbh = $this->getDBH();
        $sth = $dbh->query("SELECT * FROM `user` WHERE `login` = '".$user."' AND `pass` = '".$pass."'");
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        return $sth->fetchAll();
    }

    public function userRegistration($user, $pass, $email){

        $dbh = $this->getDBH();
        $sth = $dbh->prepare("INSERT INTO `user` (login, pass, email) values (:login, :pass, :email)");
        $sth->bindParam(':login', $user);
        $sth->bindParam(':pass', $pass);
        $sth->bindParam(':email', $email);
        if($sth->execute()){
            echo "Registration success !";
        }
    }

    public function getUserIdByLogin($login){

        $dbh = $this->getDBH();
        $sth = $dbh->query("SELECT * FROM `user` WHERE `login` = '".$login."'");
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        return $sth->fetchAll();
    }
}