<?php
session_start();
require_once ('HandlerDataBase.php');

$handler = new HandlerDataBase();

$name = mysqli_real_escape_string($mysqli_connection, $_POST['name']);

$email = mysqli_real_escape_string($mysqli_connection, $_POST['email']);

$password = md5(mysqli_real_escape_string($mysqli_connection, $_POST['password']));

$created = date('Y-m-d H:i:s');

$searchEmail = $handler->selectWhere("id","user","email = '$email'");
if (is_array($searchEmail)) {
    header('Location: logout.php');
    exit;
}

$fields = "name, email, password, created";
$values = "'$name','$email','$password','$created'";

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($mysqli_connection, $_POST['id']);
    $fields = "name = '$name', email = '$email', password = '$password', updated = '$created'";

    $resposta = $handler->update("user",$fields,"id = '$id'");

    if ($resposta == 1) {
        $_SESSION['sucess'] = true;
        header('Location: Lista.php');
        exit;
    }
    echo $resposta;
    exit;
}

$resposta = $handler->insertFields("user",$fields,$values);

if ($resposta == 1) {
    $_SESSION['sucess'] = true;
    header('Location: sign.html');
    exit;
}
echo $resposta;
exit;

?>