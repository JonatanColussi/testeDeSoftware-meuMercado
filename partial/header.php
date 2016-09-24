<?php 
session_start(); 
if(isset($_REQUEST['sair'])):
    unset($_SESSION['id_usuario']);
    unset($_SESSION['nome_usuario']);
    unset($_SESSION['email_usuario']);
    session_destroy();
    session_unset();
    header('location: index.php');
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AgendaClin</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
    </head>