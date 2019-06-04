<?php
	include('./inc/connection/connect_info.php');
	try {
		$link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	//
	echo $_POST['img'].'ok';

	//récupérer date du jour pour date d'import
	$dateImport = date("y-m-d H:i:s", time());

	//récupérer les mots-clés
	$motsCles = explode(',', $_POST['tag']);

	//récupérer id_collection à partir du nom_collection de la liste déroulante
	$collection = $link->prepare('SELECT id_collection FROM collection WHERE mail_photographe = :mail and nom_collection = :collection');

	$collection->execute(array('mail' => $_COOKIE['login'], 'collection' => $_POST['nomCollection']));

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

		//vérification ajout image
		$res = $link->prepare('SELECT * FROM image WHERE code_acces_image = ? AND desc_image = ?
			 										and lien_image = ? and mail_photographe = ? and nom_image = ?
													and id_collection = ? and prix_ht_image = ?');

		$res->execute(array($_POST['code_acces_image'], $_POST['desc_image'], $_POST['lien_image'], $_COOKIE['login'],
							$_POST['nom_image'], $idCollection, $_POST['prix_ht_image']));

		$dataImg = $res->fetch();

		if ($dataImg != NULL) {

			//vérification/ajout des tags
			$idTag = array();
			foreach ($motsCles as $val) {

				//vérification
				$res = $link->prepare('SELECT * FROM tag WHERE nom_tag = ?');
				$res->execute(array($val));

				if ($res->fetch() == NULL) {
					//ajout
					$insert = $link->prepare('INSERT INTO tag(nom_tag) VALUES (?)');
					$insert->execute(array($val));

					//vérification ajout
					$res = $link->prepare('SELECT * FROM tag WHERE nom_tag = ?');
					$res->execute(array($val));

					$dataTag = $res->fetch();
					array_push($idTag, $infosTag[0]);
				}
			}

			//liaison tags-image
			foreach ($idTag as $val) {
				$insert = $link->prepare('INSERT INTO referencer(id_tag, id_image)
														VALUES (?, ?)');
				$insert->execute(array($val, $dataImg[0]));
			}

			echo 'image importée';
		} else {
			echo "Echec de l'import";
		}




	} else {
		echo 'image existante';
	}
	echo "</br>";
	echo "<a href='/saisiePhoto.php'>Retour</a>";
?>
