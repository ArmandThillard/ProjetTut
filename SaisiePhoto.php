<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org.TR.html4/loose.dtd">
<html lang="fr">
<head>
	<meta charset="utf-8" />
      <title>Saisie photo</title>
</head>
<?php
    require('./header.php');

	if (isset($_GET['etat'])) {
		if ($_GET['etat'] == 'importee') {
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
							<h4 class="modal-title">Félicitations!</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<p>Vous venez d'ajouter une photo avec succès.</p>
							<p>Que voulez-vous faire à présent?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn" onclick="window.location.href='./saisiePhoto.php'">Ajouter une photo</button>
							<button type="button" class="btn btn-primary" onclick="window.location.href='./index.php'">Page d'accueil</button>
						</div>
					</div>
				</div>
			</div>
			<!--Fin modal erreur mdp-->
<?php
		} else {
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
							<h4 class="modal-title">Oups!</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<p>L'image que vous avez vouluu ajouter existe déjà</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn" onclick="window.location.href='./saisiePhoto.php'">Ajouter une photo</button>
							<button type="button" class="btn btn-primary" onclick="window.location.href='./index.php'">Page d'accueil</button>
						</div>
					</div>
				</div>
			</div>
			<!--Fin modal erreur mdp-->
<?php
		}
	}
?>
<body style="background-color: white;">
	<div class="container text-center">
		<h1>Nouvelle photo</h1></br>
		<form  method=post action="./ajoutPhoto.php" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="col-sm-4 col-form-label col-sm-offset-2">Nom *</label>
				<div class="col-sm-4 col-sm-offset-1">
					<input name='nom_image' type=text class="form-control " />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label col-sm-offset-2">Description de l'image *</label>
				<div class="col-sm-4 col-sm-offset-1">
					<textarea class="form-control" name='desc_image' type=text></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label col-sm-offset-2">Image privée</label>
				<div class="col-sm-4 col-sm-offset-1">
					<input class="form-control" name='image_privee' type=checkbox />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label col-sm-offset-2">Code d'accès</label>
				<div class="col-sm-4 col-sm-offset-1">
					<input class="form-control" name='code_acces_image' type=password />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label col-sm-offset-2">Prix H.T *</label>
				<div class="col-sm-4 col-sm-offset-1">
					<input class="form-control" name='prix_ht_image' type=text />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label col-sm-offset-2">Mots-clés</label>
				<div class="col-sm-4 col-sm-offset-1">
					<input class="form-control" name='tag' type=text />
				</div>
			</div>
			<?php
				include('./inc/connection/connect_info.php');
				try {
					$link = new PDO("mysql:host=$server;dbname=$db;charset=utf8",$login, $mdp);
				} catch(Exception $e) {
					die('Erreur : '.$e->getMessage());
				}

				//Liste déroulante pour le choix des catégories
				$res = $link->prepare('SELECT id_categorie, nom_categorie FROM categorie');

				$res->execute(array());


				if($res->rowCount() != 0){
					echo "<div class='form-group row'>
							<label class='col-sm-4 col-form-label col-sm-offset-2'>Catégories *</label>
							<div class='col-sm-4'>
								<select name='nomCategorie' class='form-control'/>
								<option>";
								while($data = $res->fetch()){
									echo "<option>".$data['nom_categorie'];
								}
						        echo "	</select>
							</div>
						</div>";
				} else {
					echo 'Catégories : Aucune catégorie';
				}


				//Liste déroulante pour les collections
				$res = $link->prepare('SELECT id_collection, nom_collection FROM collection WHERE mail_photographe = :mail');
				$res->execute(array('mail' => $_SESSION['login']));

				echo "<div class='form-group row'>
						<label class='col-sm-4 col-form-label col-sm-offset-2'>Collections </label>";
				if($res->rowCount() != 0){
					echo "	<div class='col-sm-4'>
								<select name='nomCollection' class='form-control'/>
								<option>";
								while($data = $res->fetch()){
									echo "<option>".$data['nom_collection'];
								}
						        echo "	</select>
								<div class='input-group'>
									<input class='form-control' id='saisieNvCol' name='nvCol' style='display:none;'></input>
									<div class='input-group-append'>
										<button type='button' class='btn' name='nouvelleCollection' onclick='addFieldCol()'>Ajouter</button>
									</div>
								</div>
							</div>
						</div>";
				} else {
					echo "<div class='col-sm-4'>
							<label class='col-sm-6 col-form-label col-sm-offset-1'>Aucune collection </label>
							<div class='input-group'>
								<input class='form-control' id='saisieNvCol' name='nvCol' style='display:none;'></input>
								<div class='input-group-append'>
									<button type='button' class='btn' name='nouvelleCollection' onclick='addFieldCol()'>Ajouter</button>
								</div>
							</div>
							</div>
						</div>";
					echo "<input type=text name=nomCollection style='display:none;'></input>";
				}

			?>

			<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
			<div class="form-group row">
				<label class="col-sm-4 col-form-label col-sm-offset-2">Image</label>
				<div class=" col-sm-4 col-sm-offset-1">
						<input type="file" name="img" class="custom-file-input">
    					<label class="custom-file-label text-left">Choose file...</label>

				</div>
			</div>

			<button type=submit class="btn btn-success" name="submit">Envoyer</>
			<script src="./inc/js/functions.js"></script>
		</form>
	</div>
</body>
<?php
    require('./footer.php');
?>
<!--
