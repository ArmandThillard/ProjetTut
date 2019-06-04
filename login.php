<?php
    require("./header.php");
 ?>
<link type="text/css" href="./style/main.css">

<div id="loginContainer" class="container d-block text-center " style="justify-content : center">
        <div class="block-header grey">
			<h1 class="block-title">Connexion</h1>
		</div>
        <form class="form-control-lg" action="./inc/connection/test_connect.php" method="post">
            <div class="form-group">
                <label for="email"> Adresse e-mail </label>
                <input class="form-control" type="email" name="login">
            </div>
            <div class="form-group">
                <label for="pwd"> Password </label>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="checkbox">
                <label><input name="chkCookies" type="checkbox"> Se souvenir de moi </label>
            </div>
            <button class="btn btn-default" type="submit" > Se connecter </button>
        </form>
</div>
<?php
    require("./footer.php");
 ?>
