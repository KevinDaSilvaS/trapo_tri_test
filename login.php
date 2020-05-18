<?php
session_start();
require_once ('HandlerDataBase.php');

$handler = new HandlerDataBase();

$email = mysqli_real_escape_string($mysqli_connection, $_POST['email']);

$password = md5(mysqli_real_escape_string($mysqli_connection, $_POST['password']));

$searchLogin = $handler->selectWhere("id","user","email = '$email' AND password = '$password'");
if (is_array($searchLogin)) {
    $_SESSION['iduser'] = $searchLogin[0]["id"];
    header('Location: UpdateProfile.php');
    exit;
}
header('Location: logout.php');
?>