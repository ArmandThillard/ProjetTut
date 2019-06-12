<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org.TR.html4/loose.dtd">
<html>
<head>
	<meta charset="utf-8" />
      <title>Inscription</title>
</head>
<?php
    require('./header.php');
	//Début condition mdp différents
	if (isset($_GET['tab'])) {

		$tab = unserialize($_GET['tab']);

		$mail = $tab[0];
		$nomP = $tab[1];
		$prenomP = $tab[2];
		$telP = $tab[3];

		$nomE = $tab[4];
		$numS = $tab[5];
		$rib = $tab[6];
		$adresseE = $tab[7];
		$cp = $tab[8];
		$ville = $tab[9];
		$telE = $tab[10];
?>
	<!--Modal erreur mdp-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#myModal").modal('show');
		});
	</script>
	<div id="myModal" class="modal fade" style="color:black;">
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
		$nomP = '';
		$prenomP = '';
		$telP = '';

		$nomE = '';
		$numS = '';
		$rib = '';
		$adresseE = '';
		$cp = '';
		$ville = '';
		$telE = '';
	}
	//fin condition mdp différents
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
			<div id="myModal" class="modal fade" style="color:black;">
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
	<div class="text-center">
		<h1 class="mt-lg-5">Inscrivez-vous</h1></br>
		<form class="was-validated" method=post action="./ajoutPhotographe.php">
            <div class="form-row">
                <div class="col-6 text-left">
                    <h2 class="col-4 offset-5 text-center">Vous</h2>
        			<div class="form-group row mt-sm-5">
        				<label class="col-sm-2 offset-2 col-form-label font-weight-bold text-left">Nom</label>
        				<div class="col-6">
        					<input name='nomPhotographe' type=text class="form-control is-invalid" value="<?php echo $nomP; ?>" required/>
        				</div>
        			</div>
        			<div class="form-group row mt-sm-4">
        				<label class="col-sm-2 offset-2 col-form-label font-weight-bold text-left">Prénom</label>
        				<div class="col-6">
        					<input class="form-control is-invalid" name='prenomPhotographe' type=text value="<?php echo $prenomP; ?>" required/>
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 offset-2 col-form-label font-weight-bold text-left">Adresse email</label>
        				<div class="col-6">
        					<input class="form-control is-invalid" name='adresseMail' type=text value="<?php echo $mail; ?>" required/>
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 offset-2 col-form-label font-weight-bold text-left">Mot de passe</label>
        				<div class="col-6">
        					<input class="form-control is-invalid" name='password' type=password required/>
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 offset-2 col-form-label font-weight-bold text-left">Confirmation</label>
        				<div class="col-6">
        					<input class="form-control is-invalid" name='confPassword' type=password required/>
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4 mb-sm-4">
        				<label class="col-sm-2 offset-2 col-form-label font-weight-bold text-left">Téléphone</label>
        				<div class="col-6">
        					<input class="form-control is-invalid" name='telPhotographe' type=text value="<?php echo $telP; ?>" required/>
        				</div>
        			</div>
                </div>

                <div class="col-6 text-left">
                    <h2 class="col-4 offset-3 text-center">L'entreprise</h2>
        			<div class="form-group row mt-sm-5">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">Nom</label>
        				<div class="col-6">
        					<input name='nomEntreprise' type=text class="form-control is-invalid" value="<?php echo $nomE; ?>" required/>
        				</div>
        			</div>
        			<div class="form-group row mt-sm-4">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">N° de SIRET</label>
        				<div class="col-6">
        					<input class="form-control is-invalid" name='numSiret' type=text value="<?php echo $numS; ?>" required/>
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">RIB</label>
        				<div class="col-6">
        					<input class="form-control is-invalid" name='rib' type=text value="<?php echo $rib; ?>" required/>
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">Adresse</label>
        				<div class="col-6">
        					<input class="form-control is-invalid" name='adresseEntreprise' type=text value="<?php echo $adresseE; ?>" required/>
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">Code Postal</label>
        				<div class="col-6">
        					<input class="form-control is-invalid" name='cpEntreprise' type=text value="<?php echo $cp; ?>" required/>
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">Ville</label>
        				<div class="col-6">
        					<input class="form-control is-invalid" name='villeEntreprise' type=text value="<?php echo $ville; ?>" required/>
        				</div>
        			</div>
                    <div class="form-group row mt-sm-4 mb-sm-5">
        				<label class="col-sm-2 col-form-label font-weight-bold text-left">Téléphone</label>
        				<div class="col-6">
        					<input class="form-control is-invalid" name='telEntreprise' type=text value="<?php echo $telE; ?>" required/>
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
