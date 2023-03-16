<?php
class Db
{

 protected function connect(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    
    try {
      $Db = new PDO("mysql:host=$servername;dbname=kompanija", $username, $password);
            return $Db;
       
    
    } catch(PDOException $e) {
      echo "Konekcija na bazu nije uspela! " . $e->getMessage();
            die();
    }



 }
    
  

}