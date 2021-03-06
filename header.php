<!--Header start-->
<header>

    <!-- Call for Bootstrap, JQuery-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style/main.css?id=v1">

    <?php
        session_start();
        // Set session values from cookies if there are any
        if(isset($_COOKIE['login'])){
            $_SESSION['user'] = $_COOKIE['user'];
            $_SESSION['login'] = $_COOKIE['login'];
            $_SESSION['password'] = $_COOKIE['password'];
            if($_SESSION['user'] == 'A'){
                $_SESSION['admin'] = $_COOKIE['admin'];
            }else{
                $_SESSION['firstName'] = $_COOKIE['firstName'];
                $_SESSION['lastName'] = $_COOKIE['lastName'];
            }
        }
    ?>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top sticky-top">
        <a class="navbar-brand" href="/"> New Horizon </a>
        <ul class="navbar-nav ml-auto">
            <?php
                if (!isset($_SESSION['login']) AND !isset($_COOKIE['login'])){
            ?>
            <li class="nav-item"><a class="nav-link" href="/register.php">Sign Up</a></li>
            <li class="nav-item"><a class="nav-link" href="/login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>
            <?php
                }else{
            ?>
            <?php

                require('./inc/connection/connect_info.php');
                try {
                       $link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
                } catch(Exception $e) {
                       die('Erreur : '.$e->getMessage());
                }

                //vérifier si l'utilisateur est un photographe
                $res = $link->prepare('SELECT * FROM photographe WHERE mail_photographe = ?');
                $res->execute(array($_SESSION['login']));

                if ($res->rowCount() != 0) {
                    echo "<li class='nav-item'><a class='nav-link' href='/saisiePhoto.php'><span class='glyphicon glyphicon-user'></span> Ajouter une photo</a></li>";
                } else {
                    //vérifier si l'utilisateur est un client
                    $res = $link->prepare('SELECT * FROM client WHERE mail_client = ?');
                    $res->execute(array($_SESSION['login']));
                    if ($res->rowCount() != 0) {
                        echo "<li class='nav-item'><a class='nav-link' href='/panier.php'><span class='glyphicon glyphicon-user'></span> Mon Panier </a></li>";
                    }
                }

            ?>
            <li class="nav-item"><a class="nav-link" href="/monCompte.php"><span class="glyphicon glyphicon-user"></span>
                <?php
                    if($_SESSION['user'] == 'A'){
                        echo $_SESSION['admin'];
                    } else {
                        echo $_SESSION['firstName']." ".$_SESSION['lastName'];
                    }

                ?>
            </a></li>

            <button class="btn btn-danger navbar-btn" onClick="window.location='./inc/connection/disconnect.php';">Se déconnecter</button>
                <?php
                    }
                ?>

        </ul>
    </nav>
</header>
