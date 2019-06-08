<?php
	include('./inc/connection/connect_info.php');
	try {
		$link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

/******************************* Récupération des données ********************************/

	//récupérer date du jour pour date d'import
	$dateImport = date("y-m-d H:i:s", time());

	//récupérer le lien de l'image à partir de l'upload
	$lienImage = 'on verra plus tard';

	//récupérer les mots-clés
	$motsCles = explode(', ', $_POST['tag']);
	echo "Tags POST : ".$_POST['tag']."</br>";
	echo "Tags explode : ".$motsCles[0]." ".$motsCles[1]."</br>";

	//récupérer id_categorie à partir du nom_categorie de la liste déroulante
	$categorie = $link->prepare('SELECT id_categorie FROM categorie WHERE nom_categorie = ?');
	$categorie->execute(array($_POST['nomCategorie']));

	$tmp = $categorie->fetch();
	$idCategorie = $tmp[0];
	echo "id catégorie : ".$idCategorie."</br>";

	//récupérer id_collection à partir du nom_collection de la liste déroulante
	$collection = $link->prepare('SELECT id_collection FROM collection WHERE mail_photographe = :mail and nom_collection = :collection');

	$collection->execute(array('mail' => $_COOKIE['login'], 'collection' => $_POST['nomCollection']));

	//$tmp variable de type array contenant valeurs de $collection
	$tmp = $collection->fetch();
	$idCollection = $tmp[0];
	echo "id collection : ".$idCollection."</br>";

	//Image privée?
	if(isset($_POST['image_visible'])) {
		$img_visible = true;
	} else {
		$img_visible = 0;
	}
	echo "img visible : ".$img_visible."</br>";
	echo "mdp = ".$_POST['code_acces_image']."</br>";



/******************************* Fin Récupération des données ********************************/

/******************************* Vérifications préliminaires ********************************/

	//vérifier si l'image existe déjà
	if ($idCollection != NULL) {
		$res = $link->prepare('SELECT * FROM image WHERE code_acces_image = ? AND desc_image = ?
			 										and lien_image = ? and mail_photographe = ? and nom_image = ?
													and id_collection = ? and prix_ht_image = ?');

		$res->execute(array($_POST['code_acces_image'], $_POST['desc_image'], $lienImage, $_COOKIE['login'],
							$_POST['nom_image'], $idCollection, $_POST['prix_ht_image']));
	} else {
		$res = $link->prepare('SELECT * FROM image WHERE code_acces_image = ? AND desc_image = ?
			 										and lien_image = ? and mail_photographe = ? and nom_image = ?
													and id_collection is ? and prix_ht_image = ?');

		$res->execute(array($_POST['code_acces_image'], $_POST['desc_image'], $lienImage, $_COOKIE['login'],
							$_POST['nom_image'], $idCollection, $_POST['prix_ht_image']));
	}

/******************************* Fin Vérifications préliminaires ********************************/

	if ($res->fetch() == NULL){
/******************************* Ajout de l'image ********************************/
		//ajouter l'image
		$insert = $link->prepare('INSERT INTO image(code_acces_image, date_upload_image, desc_image, image_visible, lien_image,
			 									mail_photographe, nom_image, id_collection, prix_ht_image)
												VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$insert->execute(array($_POST['code_acces_image'], $dateImport,
						$_POST['desc_image'], $img_visible,
					 	$lienImage, $_COOKIE['login'], $_POST['nom_image'],
						$idCollection, $_POST['prix_ht_image']));

/******************************* Fin Ajout de l'image ********************************/

/******************************* Vérifications après ajout ********************************/
		//vérification ajout image
		if ($idCollection != NULL) {
			$res = $link->prepare('SELECT * FROM image WHERE code_acces_image = ? AND desc_image = ?
				 										and lien_image = ? and mail_photographe = ? and nom_image = ?
														and id_collection = ? and prix_ht_image = ?');

			$res->execute(array($_POST['code_acces_image'], $_POST['desc_image'], $lienImage, $_COOKIE['login'],
								$_POST['nom_image'], $idCollection, $_POST['prix_ht_image']));
		} else {
			$res = $link->prepare('SELECT * FROM image WHERE code_acces_image = ? AND desc_image = ?
				 										and lien_image = ? and mail_photographe = ? and nom_image = ?
														and id_collection is ? and prix_ht_image = ?');

			$res->execute(array($_POST['code_acces_image'], $_POST['desc_image'], $lienImage, $_COOKIE['login'],
								$_POST['nom_image'], $idCollection, $_POST['prix_ht_image']));
		}
		$dataImg = $res->fetch();

/******************************* Fin Vérifications après ajout ********************************/


		if ($dataImg != NULL) {

/******************************* Lien categorie/img ********************************/
			echo "dataImg : ".$dataImg[0]."</br>";
			//liaison categorie-image

				$insert = $link->prepare('INSERT INTO correspondre(id_categorie, id_image)
														VALUES (?, ?)');
				$insert->execute(array($idCategorie, $dataImg[0]));

/******************************* Fin Lien categorie/img ********************************/


/******************************* Traitement des tags ********************************/
			//vérification/ajout des tags
			$idTag = array();
			foreach ($motsCles as $val) {

				//vérification
				$res = $link->prepare('SELECT * FROM tag WHERE nom_tag = ?');
				$res->execute(array($val));

				$tagExistant = $res->fetch();

				if ($tagExistant == NULL) {
					//ajout
					$insert = $link->prepare('INSERT INTO tag(nom_tag) VALUES (?)');
					$insert->execute(array($val));

					//vérification ajout
					$res = $link->prepare('SELECT * FROM tag WHERE nom_tag = ?');
					$res->execute(array($val));

					$dataTag = $res->fetch();
					array_push($idTag, $dataTag[0]);
				} else {
					array_push($idTag, $tagExistant[0]);
				}
			}
/******************************* Fin Traitement des tags ********************************/

/******************************* Lien tags/img ********************************/
			echo "dataImg : ".$dataImg[0]."</br>";
			//liaison tags-image
			foreach ($idTag as $val) {
				$insert = $link->prepare('INSERT INTO referencer(id_tag, id_image)
														VALUES (?, ?)');
				$insert->execute(array($val, $dataImg[0]));
			}

/******************************* Fin Lien tags/img ********************************/

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
