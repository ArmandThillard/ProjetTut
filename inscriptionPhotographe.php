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
            <br />
            <label>Prénom </label> <input name='prenomPhotographe' type=text />
            <br />
            <label>Nom </label> <input name='nomPhotographe' type=text />
            <br />
            <label>Adresse mail </label> <input name='adresseMail' type=text />
            <br />
            <label>Mot de passe </label> <input  type="password" name="password">
            <br />
            <label>Confirmer mot de passe </label> <input  type="password" name="confPassword">
            <br />
            <label>Téléphone </label> <input name='telPhotographe' type=text />
            <br />
        </div>

        <div name="infosEntreprise">
            <h2>Informations personnelles</h2>
            <label>Nom </label> <input name='nomEntreprise' type=text />
            <br />
            <label>N° de SIRET </label> <input name='numSiret' type=text />
            <br />
            <label>RIB </label> <input  type="text" name="rib">
            <br />
            <label>IBAN </label> <input  type="text" name="iban">
            <br />
            <label>Adresse </label> <input  type="text" name="adresseEntreprise">
            <br />
            <label>CP </label> <input  type="text" name="cpEntreprise"> <label>Ville </label> <input  type="text" name="villeEntreprise">
            <br />
            <label>Téléphone </label> <input name='telPhotographe' type=text />
            <br />
        </div>
        <button type=submit name="submit">Envoyer</>
        <button type=reset name="reset">Reset</>
    </form>
</body>

<?php
    require('./footer.php');
?>
</html>
