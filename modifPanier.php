<?php
    include('./inc/connection/connect_info.php');
    try {
        $link = new PDO("mysql:host=$server;dbname=$db;charset=utf8",$login, $mdp);
    } catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    echo 'qte : '.$_POST['qte'];

    //modifier la Quantité
    $update = $link->prepare('UPDATE acheter SET quantite = ? where mail_client = ? and id_support = ? and id_image = ?');
    $update -> execute(array($_POST['qte'], $_COOKIE['login'], $_GET['idS'], $_GET['idI']));

    header('Location: ./panier.php');
?>
