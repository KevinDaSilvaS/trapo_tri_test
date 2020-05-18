<?php
session_start();
include('conexao.php');

session_destroy();
header('Location: sign.html');
exit();
?>