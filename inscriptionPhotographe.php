<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org.TR.html4/loose.dtd">
<html>
<?php
    require('./header.php');
?>
<h1>Inscription photographe</h1>
    <form method=post action="./ajoutPhotographe.php">
        <h2>Informations personnelles</h2>
        <div name="infosPerso">
            <label>Civilité </label> <input name='homme' type='radio'> M. </input>
                                     <input name='femme' type='radio'> Mme </input>
                                     <input name='autre' type='radio'> Autre </input>
            <div class="form-group">
                <label for="nom"> Nom </label>
                <div class="input-group">
                    <input type="text" name="nomPhotographe">
                </div>
            </div>
            <div class="form-group">
                <label for="prenom"> Prénom </label>
                <div class="input-group">
                    <input type="text" name="prenomPhotographe">
                </div>
            </div>
            <div class="form-group">
                <label for="mail"> Adresse email </label>
                <div class="input-group">
                    <input type="text" name="adresseMail">
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
                    <input type="password" name="confPassword">
                </div>
            </div>
            <div class="form-group">
                <label for="telPhotographe"> Téléphone </label>
                <div class="input-group">
                    <input type="text" name="telPhotographe">
                </div>
            </div>
        </div>

        <div name="infosEntreprise">
            <h2>Informations Entreprise</h2>
            <div class="form-group">
                <label for="nomEntreprise"> Nom de l'entreprise </label>
                <div class="input-group">
                    <input type="text" name="nomEntreprise">
                </div>
            </div>
            <div class="form-group">
                <label for="numSiret"> N° de SIRET </label>
                <div class="input-group">
                    <input type="text" name="numSiret">
                </div>
            </div>
            <div class="form-group">
                <label for="rib"> RIB </label>
                <div class="input-group">
                    <input type="text" name="rib">
                </div>
            </div>
            <div class="form-group">
                <label for="iban"> IBAN </label>
                <div class="input-group">
                    <input type="text" name="iban">
                </div>
            </div>
            <div class="form-group">
                <label for="adresseEntreprise"> Adresse </label>
                <div class="input-group">
                    <input type="text" name="adresseEntreprise">
                </div>
            </div>
            <div class="form-group">
                <label for="cpEntreprise"> Code Postal </label>
                <div class="input-group">
                    <input type="text" name="cpEntreprise">
                </div>
            </div>
            <div class="form-group">
                <label for="villeEntreprise"> Ville </label>
                <div class="input-group">
                    <input type="text" name="villeEntreprise">
                </div>
            </div>
            <div class="form-group">
                <label for="telPhotographe"> Téléphone </label>
                <div class="input-group">
                    <input type="text" name="telPhotographe">
                </div>
            </div>
        </div>
        <button type=submit name="submit">Envoyer</>
        <button type=reset name="reset">Reset</>
    </form>
</body>

<?php
    require('./footer.php');
?>
</html>
