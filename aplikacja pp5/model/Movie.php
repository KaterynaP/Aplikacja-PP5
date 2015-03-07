<?php
require_once("db.php");

class Movie extends Db{

    public function fetchAll(){

        $dbh = $this->getDBH();
        $sth = $dbh->query("SELECT * FROM `movie`");
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        return $sth->fetchAll();
    }

    public function fetchById($id){

        $dbh = $this->getDBH();
        $sth = $dbh->query("SELECT * FROM `movie` WHERE `id` = '".$id."'");
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        return $sth->fetchAll();
    }

    public function fetchNameById($id){

        $dbh = $this->getDBH();
        $sth = $dbh->query("SELECT `name` FROM `movie` WHERE `id` = '".$id."'");
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        return $sth->fetchAll();
    }

    public function insertComment($comment, $movie_id){

        $dbh = $this->getDBH();
        $sth = $dbh->prepare("INSERT INTO `comments` (movie_id, comment, com_date) values (:movie_id, :comment, :com_date)");
        $com_date = date( 'Y-m-d H-i-s', time());
        $sth->bindParam(':movie_id', $movie_id);
        $sth->bindParam(':comment', $comment);
        $sth->bindParam(':com_date', $com_date);
        $sth->execute();
    }

    public function selectCommented(){

        $dbh = $this->getDBH();
        $sth = $dbh->query("SELECT `movie_id`, COUNT(`movie_id`) as 'comments_count' FROM `comments`
    GROUP BY `movie_id` ORDER BY `comments_count` DESC LIMIT 3");
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        return $sth->fetchAll();
    }
}