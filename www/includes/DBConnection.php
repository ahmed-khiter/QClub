<?php
try{
    $connection = new PDO("mysql:hostname=localhost;dbname=coffee_shop","root","");
    //$connection = new PDO("sqlite:app_db.sqlite3");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    throw $e;
}