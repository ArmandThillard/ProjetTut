<?php
    include('./inc/connection/connect_info.php');
    require('./header.php');
    try {
        $link = new PDO("mysql:host=$server;dbname=$db;charset=utf8",$login, $mdp);
    } catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    echo 'qte : '.$_POST['qte'];

    //modifier la Quantité
    $update = $link->prepare('DELETE FROM acheter where mail_client = ? and id_support = ? and id_image = ?');
    $update -> execute(array($_SESSION['login'], $_GET['idS'], $_GET['idI']));

    header('Location: ./panier.php');
?>
