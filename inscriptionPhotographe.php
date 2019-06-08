<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org.TR.html4/loose.dtd">
<html>
<head>
	<meta charset="utf-8" />
      <title>Inscription</title>
</head>
<?php
    require('./header.php');
?>
<body>
	<div class="text-center">
		<h1 class="mt-lg-5">Inscrivez-vous</h1></br>
		<form  method=post action="./ajoutClient.php">
            <div class="form-row">
                <div class="col-6 text-left">
                    <h2 class="col-4 offset-5 text-center">Vous</h2>
        			<div class="form-group row mt-sm-5">
        				<label class="col-sm-2 offset-2 col-form-label font-weight-bold text-left">Nom</label>
        				<div class="col-6">
        					<input name='nomPhotographe' type=text class="form-control " />
        				</div>
        			</div>
        			<div class="form-group row mt-sm-4">
        				<label class="col-sm-2 offset-2 col-form-label font-weight-bold text-left">Prénom</label>
        				<div class="col-6">
        					<input class="form-control" name='prenomPhotographe' type=text />
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 offset-2 col-form-label font-weight-bold text-left">Adresse email</label>
        				<div class="col-6">
        					<input class="form-control" name='adresseMail' type=text />
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 offset-2 col-form-label font-weight-bold text-left">Mot de passe</label>
        				<div class="col-6">
        					<input class="form-control" name='password' type=password />
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 offset-2 col-form-label font-weight-bold text-left">Confirmation</label>
        				<div class="col-6">
        					<input class="form-control" name='confPassword' type=password />
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4 mb-sm-4">
        				<label class="col-sm-2 offset-2 col-form-label font-weight-bold text-left">Téléphone</label>
        				<div class="col-6">
        					<input class="form-control" name='telPhotographe' type=text />
        				</div>
        			</div>
                </div>

                <div class="col-6 text-left">
                    <h2 class="col-4 offset-3 text-center">L'entreprise</h2>
        			<div class="form-group row mt-sm-5">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">Nom</label>
        				<div class="col-6">
        					<input name='nomEntreprise' type=text class="form-control " />
        				</div>
        			</div>
        			<div class="form-group row mt-sm-4">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">N° de SIRET</label>
        				<div class="col-6">
        					<input class="form-control" name='numSiret' type=text />
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">RIB</label>
        				<div class="col-6">
        					<input class="form-control" name='rib' type=text />
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">Adresse</label>
        				<div class="col-6">
        					<input class="form-control" name='adresseEntreprise' type=text />
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">Code Postal</label>
        				<div class="col-6">
        					<input class="form-control" name='cpEntreprise' type=text />
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">Ville</label>
        				<div class="col-6">
        					<input class="form-control" name='villeEntreprise' type=text />
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4 mb-sm-5">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">Téléphone</label>
        				<div class="col-6">
        					<input class="form-control" name='telEntreprise' type=text />
        				</div>
        			</div>
                </div>
            </div>

            <button type=reset class="btn btn-light mr-sm-5" name="reset">Annuler</button>
			<button type=submit class="btn btn-success ml-sm-5" name="submit">Envoyer</button>
		</form>
	</div>
</body>
<?php
    require('./footer.php');
?>
</html>
