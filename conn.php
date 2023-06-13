<?php 
    try{
        $host = "localhost";
    $dbname = "4bblog";
    $user = "root";
    $password = "";

    $conn = new PDO ("mysql:host=$host;dbname=$dbname;user=$user;password=$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>