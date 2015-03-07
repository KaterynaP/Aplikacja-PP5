<?php
class Db{

    public function  getDBH(){

        $host = "vitafran.mysql.ukraine.com.ua";
        $dbname = "vitafran_pp5";
        $user = "vitafran_pp5";
        $pass = "pgvdkblb";

        try {
            # MS SQL Server и Sybase через PDO_DBLIB
            //$DBH = new PDO("mssql:host=$host;dbname=$dbname", $user, $pass);
            //$DBH = new PDO("sybase:host=$host;dbname=$dbname", $user, $pass);

            # MySQL через PDO_MYSQL
            $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

            # SQLite
            //$DBH = new PDO("sqlite:my/database/path/database.db");

            $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            return $DBH;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}