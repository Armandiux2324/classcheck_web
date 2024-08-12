<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['grupo_id'] = $_POST['grupo_id'];
}
?>
