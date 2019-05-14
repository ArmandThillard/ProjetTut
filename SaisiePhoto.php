<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org.TR.html4/loose.dtd">
<html>
<head>
	<meta charset="utf-8" />
      <title>Horizon</title>
	  <script src="./inc/js/functions.js" type="text/javascript"></script>
      	<link rel="stylesheet" href="./css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="./style/style.css"
      	<link rel="shortcut icon" type="image/x-icon" href="./Tank.ico" />

</head>
<?php
	include("./inc/HTMLInserts/header.php");
?>
<body>
	<h1>Saisie</h1>
	<form method=post action="./AjoutPhoto.php">
		<label>Code d'accès (si privée) </label> <input name='code_acces_image' type=text />
		<br />
		<label>Description de l'image </label> <input name='desc_image' type=text />
		<br />
		<label>Image privée </label> <input name='image_visible' type=radio />
		<br />
		<label>Lien de l'image </label> <input name='lien_image' type=text />
		<br />
		<label>Prix H.T. </label> <input name='prix_ht_image' type=text />
		<br />
		<label>Nom de l'image </label> <input name='nom_image' type=text />
		<br />

		<?php
			include('./inc/connection/connect_info.php');
			try {
				$link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
			} catch(Exception $e) {
				die('Erreur : '.$e->getMessage());
			}

			$res = $link->prepare('SELECT id_collection, nom_collection FROM collection WHERE mail_photographe = :mail');

			$res->execute(array('mail' => $_COOKIE['login']));
			if($res->rowCount() != 0){
				echo '<label>Collections </label> ';
				echo "<select name='nom_collection'>";
				while($data = $res->fetch()){
					echo "<option>".$data['nom_collection'];
				}
				echo "	</select>";
			} else {
				echo 'Collections : Aucune collection';
			}
		?>
		</br>
		<button type=submit name="submit">Envoyer</>
		<button type=reset name="reset">Reset</>
	</form>
</body>
</html>
