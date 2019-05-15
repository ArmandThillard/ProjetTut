<?php
    require("./header.php");
 ?>
<div class="container block text-center">
    <div class="well">
        <div class="block-header grey">
			<span class="block-title">Connexion</span>
		</div>
        <form class="form-horizontal" action="./inc/connection/test_connect.php" method="post">
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
</div>
<?php
    require("./footer.php");
 ?>
