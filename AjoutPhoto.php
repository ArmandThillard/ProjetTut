<?php
	include('./inc/connection/connect_info.php');
	try {
		$link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	//récupérer date du jour pour date d'import
	$dateImport = date("y-m-d H:i:s", time());

	//récupérer les mots-clés
	$motsCles = explode(',', $_POST['tag']);

	//récupérer id_collection à partir du nom_collection de la liste déroulante
	$collection = $link->prepare('SELECT id_collection FROM collection WHERE mail_photographe = :mail and nom_collection = :collection');

	$collection->execute(array('mail' => $_COOKIE['login'], 'collection' => $_POST['nom_collection']));

	//$tmp variable de type array contenant valeurs de $collection
	$tmp = $collection->fetch();
	$idCollection = $tmp[0];

	//vérifier si l'image existe déjà
	$res = $link->prepare('SELECT * FROM image WHERE code_acces_image = ? AND desc_image = ?
		 										and lien_image = ? and mail_photographe = ? and nom_image = ?
												and id_collection = ? and prix_ht_image = ?');

	$res->execute(array($_POST['code_acces_image'], $_POST['desc_image'], $_POST['lien_image'], $_COOKIE['login'],
						$_POST['nom_image'], $idCollection, $_POST['prix_ht_image']));

	if ($res->fetch() == NULL){
		if(isset($_POST['image_visible'])) {
			$img_visible = true;
		} else {
			$img_visible = false;
		}
		//ajouter l'image
		$insert = $link->prepare('INSERT INTO image(code_acces_image, date_upload_image, desc_image, image_visible, lien_image,
			 									mail_photographe, nom_image, id_collection, prix_ht_image)
												VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$insert->execute(array($_POST['code_acces_image'], $dateImport,
						$_POST['desc_image'], $img_visible,
					 	$_POST['lien_image'], $_COOKIE['login'], $_POST['nom_image'],
						$idCollection, $_POST['prix_ht_image']));

		echo 'image importée';
	} else {
		echo 'image existante';
	}
	echo "</br>";
	echo "<a href='/saisiePhoto.php'>Retour</a>";
?>
