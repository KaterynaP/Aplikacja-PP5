<?php
require_once("db.php");
class Order extends Db{

    public function selectUserOrder($id){

        $dbh = $this->getDBH();
        $sth = $dbh->query("SELECT * FROM `order` WHERE `user_id` = '".$id."'");
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        return $sth->fetchAll();
    }

    public function insertOrder($user_id, $film_id){

        $order_date = date( 'Y-m-d', time());
        $status = "in progress";

        $dbh = $this->getDBH();
        $sth = $dbh->prepare("INSERT INTO `order` (user_id, film_id, order_date, status) values (:user_id, :film_id, :order_date, :status)");
        $sth->bindParam(':user_id', $user_id);
        $sth->bindParam(':film_id', $film_id);
        $sth->bindParam(':order_date', $order_date);
        $sth->bindParam(':status', $status);
        if($sth->execute()){
            echo "Order added successful !";
            return true;
        }else{
            echo "Error in adding order";
            return false;
        }
    }

    public function sendMail($mail){

        $theme = "Your order information";
        $text = "
                        <h3>Information about your order</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    ";
        if(mail($mail, $theme, $text)){
            echo "Check your mail - letter with info about your order must be there";
        }
    }

    public function selectOrdered(){

        $dbh = $this->getDBH();
        $sth = $dbh->query("SELECT `film_id`, COUNT(`film_id`) as 'comments_count' FROM `order`
    GROUP BY `film_id` ORDER BY `comments_count` DESC LIMIT 3");
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        return $sth->fetchAll();
    }
}