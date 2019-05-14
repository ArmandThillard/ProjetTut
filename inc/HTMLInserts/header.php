<!--Header start-->
<header>

<?php
    session_start();

    // Set $_SESSION depuis cookies
    if(isset($_COOKIE['login'])){
        $_SESSION['user'] = $_COOKIE["user"];
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
<div class="logo">
    <a href="/"> New Horizon </a>
</div>

<div class="loginDiv">
    <div id="loginButton">
        <?php
            if(isset($_SESSION['user'])){
                echo "<label>";
                    if ($_SESSION['user'] == 'A'){
                        echo $_SESSION['admin'];
                    }else{
                        echo $_SESSION['firstName'].' '.$_SESSION['lastName'];
                    }
            }else{
                echo "<label> Connexion";
            }
            echo "</label>";
        ?>
        <button name="btConnect" onclick="showConnectDiv()"><img id="imgAccueil" src="./img/connectIcon.png"></button>
    </div>
    <?php
        if((!isset($_SESSION['login'])) AND (!isset($_COOKIE['login']))){
    ?>

    <!--Connect Divs-->
    <div class="connectDiv" style="display:none;">
        <form method=post action="./inc/connection/test_connect.php">
            <label>Login</label> <input type=text name="login" placeholder="adresse@mail.com" /> <br>
            <label>Mot de passe</label> <input type=password name="password" /> <br />
            <input type=checkbox name="chkCookies" value=true /> Se souvenir de moi <br>
            <button type=submit value="submit"> Se connecter </button> <br>
            <a href="./accountCreation.php">Pas encore de compte ? Rejoignez nous !</a> <br>
            <a href="./passwordLost.php">Mot de passe oublié ?</a>
        </form>
    </div>
    <?php
        }else{
    ?>
    <div class="connectDiv" style="display:none;">
        <nav>
            <ul>
                <li><a href="profil.php"> Mon Profil </a></li>
                <li><a href="SaisiePhoto.php"> Ajouter une photo </a></li>
                <li><a href="mesPhotos.php"> Gérer mes photos </a></li>
                <li><a href="./inc/connection/disconnect.php"> Se déconnecter </a></li>
            </ul>
        </nav>
    </div>
    <?php
        }
    ?>
    <!--End Connect Divs-->
</div>
<!--Header end-->
</header>
