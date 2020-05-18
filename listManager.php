<?php
session_start();
isset($_SESSION['iduser']) ? 
$idUser = $_SESSION['iduser'] 
: header('Location: logout.php');

require_once ('HandlerDataBase.php');

$handler = new HandlerDataBase();

$name = mysqli_real_escape_string($mysqli_connection, $_POST['name']);

$desc = mysqli_real_escape_string($mysqli_connection, $_POST['desc']);

$moment = date('Y-m-d H:i:s');

$fields = "user,name,description,created";
$values = "'$idUser','$name','$desc','$moment'";

if (isset($_POST['idlist']) && $_POST['idlist'] > 0) {

    $idList = $_POST['idlist'];
    $response = $handler->update(
    "list",
    "name = '$name', description = '$desc', updated = '$moment'",
    "id = '$idList'");

    if (isset($_POST['createdtask'])) {
        foreach ($_POST['createdtask'] as $key => $value) {
            $taskName = mysqli_real_escape_string($mysqli_connection, $value);
            $due = mysqli_real_escape_string($mysqli_connection, $_POST['createddue'][$key]);
            $taskId = mysqli_real_escape_string($mysqli_connection, $_POST['taskid'][$key]);
            $taskController = $handler->update("tasks",
            " description = '$taskName', due = '$due', updated = '$moment'",
            "id = '$taskId'");
        }
    }

}else {

    $response = $handler->insertFields("list",$fields,$values);
    $idList = $handler->selectLastLineOfTable("id","list","id");
    $idList = $idList[0]['id'];
}

if (isset($_POST['task'])) {
    foreach ($_POST['task'] as $key => $value) {
        $taskName = mysqli_real_escape_string($mysqli_connection, $value);
        $due = mysqli_real_escape_string($mysqli_connection, $_POST['due'][$key]);
        $taskController = $handler->insertFields("tasks","list, description, due, created",
        "'$idList','$taskName','$due','$moment'");
    }
}

if ($response == 1) {
    $_SESSION['sucess'] = true;
    header('Location: ListOfLists.php');
    exit;
}
echo $response;
exit;
?>