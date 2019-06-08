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
	<div class="container text-center">
		<h1 class="mt-lg-5">Inscrivez-vous</h1></br>
		<form  method=post action="./ajoutClient.php">
			<div class="form-group row mt-sm-5">
				<label class="col-sm-2 col-form-label offset-sm-2 font-weight-bold text-left">Nom</label>
				<div class="col-sm-4 ">
					<input name='nom' type=text class="form-control " />
				</div>
			</div>
			<div class="form-group row mt-sm-4">
				<label class="col-sm-2 col-form-label offset-sm-2 font-weight-bold text-left">Prénom</label>
				<div class="col-sm-4">
					<input class="form-control" name='prenom' type=text />
				</div>
			</div>
            <div class="form-group row mt-sm-4">
				<label class="col-sm-2 col-form-label offset-sm-2 font-weight-bold text-left">Adresse email</label>
				<div class="col-sm-4">
					<input class="form-control" name='mail' type=text />
				</div>
			</div>
            <div class="form-group row mt-sm-4">
				<label class="col-sm-2 col-form-label offset-sm-2 font-weight-bold text-left">Mot de passe</label>
				<div class="col-sm-4">
					<input class="form-control" name='password' type=password />
				</div>
			</div>
            <div class="form-group row mt-sm-4">
				<label class="col-sm-2 col-form-label offset-sm-2 font-weight-bold text-left">Confirmation</label>
				<div class="col-sm-4 ">
					<input class="form-control" name='password2' type=password />
				</div>
			</div>
            <div class="form-group row mt-sm-4 mb-sm-4">
				<label class="col-sm-2 col-form-label offset-sm-2 font-weight-bold text-left">Téléphone</label>
				<div class="col-sm-4">
					<input class="form-control" name='telClient' type=text />
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
