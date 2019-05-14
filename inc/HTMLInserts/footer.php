<!--Header start-->
<footer>
<?php
    session_start();
    session_destroy();
?>
<div id="loginDiv">
    <button name="btConnect" onclick="showConnectDiv()"><img src="./img/connectIcon.png" height="3.5%"></button>
    <?php
        if(isset($_SESSION['user'])){
            echo "<p id=\"connectedSentence\">Connecté en tant que : ";
                switch ($_SESSION['user']){
                    case 'A' :
                        echo $_SESSION['admin'];
                        break;
                    default :
                        echo $_SESSION['firstName'].' '.$_SESSION['lastName'];
                        break;
                }
            echo "</p>";
        }
        if((!isset($_SESSION['login'])) OR (!isset($_COOKIE['login']))){
    ?>

    <!--Connect Divs-->
    <div class="connectDiv" style="display:none;">
        <form method=post action="./inc/connection/test_connect.php">
            <label>Login</label> <input type=text name="login" placeholder="adresse@mail.com" /> <br>
            <label>Mot de passe</label> <input type=password name="password" /> <br />
            <input type=checkbox name="chkCookies" /> Se souvenir de moi <br>
            <button type=submit value="submit"> Se connecter </button> <br>
            <a href="./accountCreation.php">Pas encore de compte ? Rejoignez nous !</a> <br>
            <a href="./passwordLost.php">Mot de passe oublié ?</a>
        </form>
    </div>
    <?php
        }else{
    ?>
    <div class="connectDiv" style="display:none;">
        <form action="./inc/connection/disconnect.php">
            <button type=submit value="deco"> Se deconnecter </button>
        </form>
    </div>
    <?php
        }
    ?>
</div>
<!--End Connect Divs-->
<!--Header end-->
</footer>
