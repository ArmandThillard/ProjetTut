<?php
    require('./header.php');
?>
<body>
    <div id="registerContainer" class="container">
        <h1> Vous êtes... </h1>
        <div class="row">
            <div class="container col">
                <h2> un client </h2>
                <div>
                    <form method="post" action="./inscriptionClient.php">
                        <div class="form-group">
                            <label for="nom"> Nom </label>
                            <div class="input-group">
                                <input type="text" name="nom">
                            </div>
                            <label for="prenom"> Prénom </label>
                            <div class="input-group">
                                <input type="text" name="prenom">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mail"> Adresse email </label>
                            <div class="input-group">
                                <input type="text" name="mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password"> Mot de passe </label>
                            <div class="input-group">
                                <input type="password" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password2"> Confirmation </label>
                            <div class="input-group">
                                <input type="password" name="password2">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container col">
                <form method="post" action="./inscriptionPhotographe.php">
                    <div class="input-group">
                        <label for="lastName"> Nom </label>
                        <input type="text" name="nom">
                    </div>
                    <div class="input-group">
                        <label for="firstName"> Prénom </label>
                        <input type="text" name="prenom">
                    </div>
                    <div class="input-group">
                        <label for="email"> Adresse email </label>
                        <input type="text" name="mail">
                    </div>
                    <div class="input-group">
                        <label for="password"> Mot de passe </label>
                        <input type="password" name="password">
                    </div>
                    <div class="input-group">
                        <label for="password"> Confirmation </label>
                        <input type="password" name="password2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
    require('./footer.php');
?>
