<?php
session_start();
isset($_SESSION['iduser']) ? 
$idUser = $_SESSION['iduser'] 
: header('Location: logout.php');

isset($_GET['listId']) ? 
$listId = $_GET['listId'] 
: header('Location: logout.php');

require_once ('HandlerDataBase.php');

$handler = new HandlerDataBase();

$listId = mysqli_real_escape_string($mysqli_connection, $listId);

$searchCredentials = $handler->selectWhere("id","list","user = '$idUser' AND id = '$listId'");
if (is_array($searchCredentials)) {
    $removeList = $handler->delete("list","id = '$listId'");
}

header('Location: ListOfLists.php');
exit;
?>