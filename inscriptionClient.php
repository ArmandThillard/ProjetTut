<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org.TR.html4/loose.dtd">
<html>
<head>
	<meta charset="utf-8" />
      <title>Inscription</title>
</head>
<?php
    require('./header.php');
	//Début condition
	if (isset($_GET['mail'])) {
		$mail = $_GET['mail'];
		$nom = $_GET['nom'];
		$prenom = $_GET['prenom'];
		$tel = $_GET['tel'];
?>
	<!--Modal erreur mdp-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#myModal").modal('show');
		});
	</script>
	<div id="myModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Attention!</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Les mots de passe ne correspondent pas</p>
					<p>Veuillez saisir deux mots de passes identiques</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-dismiss="modal">Ok</button>
				</div>
			</div>
		</div>
	</div>
	<!--Fin modal erreur mdp-->
<?php
	} else {
		$mail = '';
		$nom = '';
		$prenom = '';
		$tel = '';
	}
	//fin condition
	//début condition inscription ok
	if (isset($_GET['page'])) {
		?>
			<!--Modal connecté-->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){
					$("#myModal").modal('show');
				});
			</script>
			<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Félicitations!</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<p>Que voulez-vous faire?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn" onclick="window.location.href='./login.php'">Se connecter</button>
							<button type="button" class="btn btn-primary" onclick="window.location.href='./index.php'">Page d'accueil</button>
						</div>
					</div>
				</div>
			</div>
			<!--Fin modal connecté-->

		<?php
	}
	//fin condition inscription ok
?>
<body>
	<div class="container text-center">
		<h1 class="mt-lg-5">Inscrivez-vous</h1></br>
		<form  method=post action="./ajoutClient.php">
			<div class="form-group row mt-sm-5">
				<label class="col-sm-2 col-form-label offset-sm-2 font-weight-bold text-left">Nom</label>
				<div class="col-sm-4 ">
					<input name='nom' type=text class="form-control " value="<?php echo $nom; ?>"/>
				</div>
			</div>
			<div class="form-group row mt-sm-4">
				<label class="col-sm-2 col-form-label offset-sm-2 font-weight-bold text-left">Prénom</label>
				<div class="col-sm-4">
					<input class="form-control" name='prenom' type=text value="<?php echo $prenom; ?>"/>
				</div>
			</div>
            <div class="form-group row mt-sm-4">
				<label class="col-sm-2 col-form-label offset-sm-2 font-weight-bold text-left">Adresse email</label>
				<div class="col-sm-4">
					<input class="form-control" name='mail' type=text value="<?php echo $mail; ?>"/>
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
					<input class="form-control" name='telClient' type=text value="<?php echo $tel; ?>"/>
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
