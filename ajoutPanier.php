<?php
    require('./header.php');
    include('./inc/connection/connect_info.php');
    try {
        $link = new PDO("mysql:host=$server;dbname=$db;charset=utf8",$login, $mdp);
    } catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //récupérer les infos sur la photo
    $res = $link->prepare('SELECT * FROM image WHERE id_image = ?');
    $res->execute(array($_GET['id']));

    $donneesImages = $res->fetch();

    //récupérer les infos sur le support
    $typeSupport = explode(' -', $_POST['support']);
    $res = $link->prepare('SELECT * FROM support WHERE type_support = ?');
    $res->execute(array($typeSupport[0]));

    $donneesSupport = $res->fetch();

    echo "login : ".$_SESSION['login'].'</br>';
    echo "type support : ".$typeSupport[0].'</br>';
    echo "id support : ".$donneesSupport['id_support'].'</br>';
    echo "id img  : ".$donneesImages['id_image'].'</br>';
    echo "qte : ".$_POST['qte'].'</br>';

    //ajout de l'article au panier
    $insert = $link->prepare('INSERT INTO acheter(mail_client, id_support, id_image, quantite)
                                            VALUES (?, ?, ?, ?)');
    $insert->execute(array($_SESSION['login'], $donneesSupport['id_support'], $donneesImages['id_image'], $_POST['qte']));

    header('Location: ./photo.php?id='.$donneesImages['id_image'].'&page=ajoutee');

?>
