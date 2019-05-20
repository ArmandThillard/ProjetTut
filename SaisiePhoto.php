<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org.TR.html4/loose.dtd">
<html>
<?php
	require("./header.php");

?>
<body>
	<h1>Saisie</h1>
	<form method=post action="./ajoutPhoto.php">
		<label>Nom de l'image </label> <input name='nom_image' type=text />
		<br />
		<label>Description de l'image </label> <input name='desc_image' type=text />
		<br />
		<label>Lien de l'image </label> <input name='lien_image' type=text />
		<br />
		<label>Image privée </label> <input name='image_visible' type=radio />
		<br />
		<label>Code d'accès (si privée) </label> <input name='code_acces_image' type=text />
		<br />
		<label>Prix H.T. </label> <input name='prix_ht_image' type=text />
		<br />
		<label>Catégorie </label> <input name='catégorie' type=text />
		<br />
		<label>Mots-clés </label> <input name='tag' type=text />
		<br />


		<?php
			include('./inc/connection/connect_info.php');
			try {
				$link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
			} catch(Exception $e) {
				die('Erreur : '.$e->getMessage());
			}

			$res = $link->prepare('SELECT id_categorie, nom_categorie FROM categorie');

			$res->execute(array());

			if($res->rowCount() != 0){
				echo '<label>Categories </label> ';
				echo "<select name='nomCategorie'>";
				while($data = $res->fetch()){
					echo "<option>".$data['nom_categorie'];
				}
				echo "	</select>";
			} else {
				echo 'Catégories : Aucune catégorie';
			}
		?>
		<input id="saisieNvCat" style="display:none;"></input>
		<button type="button" name="nouvelleCategorie" onclick="addFieldCat()">+</button>
		</br>

		<?php
			include('./inc/connection/connect_info.php');
			try {
				$link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
			} catch(Exception $e) {
				die('Erreur : '.$e->getMessage());
			}

			$res = $link->prepare('SELECT id_collection, nom_collection FROM collection WHERE mail_photographe = :mail');
			$res->execute(array('mail' => $_SESSION['login']));

			if($res->rowCount() != 0){
				echo '<label>Collections </label> ';
				echo "<select name='nomCollection'>";
				while($data = $res->fetch()){
					echo "<option>".$data['nom_collection'];
				}
				echo "	</select>";
			} else {
				echo 'Collections : Aucune collection';
				echo "<input type=text name=nomCollection style='display:none;'></input>";
			}
		?>
		<input id="saisieNvCol" style="display:none;"></input>
		<button type="button" name="nouvelleCollection" onclick="addFieldCol()">+</button>
		</br>
		<script src="./inc/js/functions.js"></script>
		<button type=submit name="submit">Envoyer</>
		<button type=reset name="reset">Reset</>
	</form>
</body>
<?php
	require("./footer.php");
?>
</html>
