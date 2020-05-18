<?php
session_start();
isset($_SESSION['iduser']) ? 
$idUser = $_SESSION['iduser'] 
: header('Location: logout.php');

isset($_GET['listId']) ? 
$listId = $_GET['listId'] 
: header('Location: logout.php');

isset($_GET['taskIds']) ? 
$taskIds = $_GET['taskIds'] 
: header('Location: logout.php');

$arrayIds = explode(",", $taskIds);
require_once ('HandlerDataBase.php');

$handler = new HandlerDataBase();

$listId = mysqli_real_escape_string($mysqli_connection, $listId);

$moment = date('Y-m-d H:i:s');

$searchCredentials = $handler->selectWhere("id","list","user = '$idUser' AND id = '$listId'");
if (!is_array($searchCredentials)) {
    header('Location: ListOfLists.php');
    exit;
}

if (is_array($arrayIds)) {
    foreach ($arrayIds as $key => $value) {
        $searchCredentials = $handler->selectWhere("id","tasks","list = '$listId' AND id = '$value'");
        if (is_array($searchCredentials)) {
            $response = $handler->update("tasks","completed = '$moment'","id = '$value'");
        }
    }
}

header('Location: ListOfLists.php');
exit;
?>