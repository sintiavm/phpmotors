<?php
    function phpmotorsConnect(){
        $host = '127.0.0.1';
        $dbname = 'phpmotors';
        $username = 'root';
        $password = '';
        $dsn = "mysql:host=$host;dbname=$dbname";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        //create the actual connection object and assign it to a variable
        try{
            $db = new PDO($dsn, $username, $password, $options);
            return $db;
        }catch(PDOException $e){
            header('Location: ../view/500.php');
            exit;
        }
    }
    phpmotorsConnect();

?>
