<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

if(isset($_POST['submit'])){
    if(isset($_POST['searchUser']) && empty($_POST['txt_titulo'])){
        echo '<script>alert("Sin resultados de búsqueda")</script>';
        }
    else{
        $username = $_POST['searchUser'];
        $query = "SELECT * FROM users WHERE username like '$username'";
        $result = $conn->query($query);
        if(!$result) die("Error");
        $rows = $result->num_rows;
    }
    $conn->close();
    }
    else{
        echo "Sin búsqueda";
    }
