<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $db_host = 'localhost';
        $db_user = 'root';
        $db_password = 'root';
        $db_db = 'Shop';

        $mysqli = @new mysqli(
        $db_host,
        $db_user,
        $db_password,
        $db_db
        );
        $sql = "DELETE FROM clients WHERE id=$id";
        $mysqli->query($sql);
    }
    header("location:/ReapetCrud/index.php");
    exit;
?>
