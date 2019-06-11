

<?php
	require('./header.php');
	include('./inc/connection/connect_info.php');
	try {
		$link = new PDO("mysql:host=$server;dbname=$db;charset=utf8",$login, $mdp);
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

/******************************* Récupération des données ********************************/

	//récupérer date du jour pour date d'import
	$dateImport = date("y-m-d H:i:s", time());

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
	$collection = $link->prepare('SELECT id_collection, nom_collection FROM collection WHERE mail_photographe = :mail and nom_collection = :collection');

	$collection->execute(array('mail' => $_SESSION['login'], 'collection' => $_POST['nomCollection']));

	$tmp = $collection->fetch();
	$idCollection = $tmp[0];
	$nomCollection = $tmp[1];


	//Image privée?
	if(isset($_POST['image_privee'])) {
		$img_visible = 0;
		$codeAccesImg = $_POST['code_acces_image'];
	} else {
		$img_visible = true;
		$codeAccesImg = '';
	}
	echo "img visible : ".$img_visible."</br>";
	echo "mdp = ".$_POST['code_acces_image']."</br>";
	echo "id collection : ".$idCollection."</br>";

/******************************* Fin Récupération des données ********************************/

/******************************* Vérifications préliminaires ********************************/

	//vérifier si l'image existe déjà
	if ($idCollection != NULL) {
		$res = $link->prepare('SELECT * FROM image WHERE code_acces_image = ? AND desc_image = ?
			 										and mail_photographe = ? and nom_image = ?
													and id_collection = ? and prix_ht_image = ?');

		$res->execute(array($codeAccesImg, $_POST['desc_image'], $_SESSION['login'],
							$_POST['nom_image'], $idCollection, $_POST['prix_ht_image']));
	} else {
		$res = $link->prepare('SELECT * FROM image WHERE code_acces_image = ? AND desc_image = ?
			 										and mail_photographe = ? and nom_image = ?
													and id_collection is ? and prix_ht_image = ?');

		$res->execute(array($codeAccesImg, $_POST['desc_image'], $_SESSION['login'],
							$_POST['nom_image'], $idCollection, $_POST['prix_ht_image']));
	}

/******************************* Fin Vérifications préliminaires ********************************/

	if ($res->fetch() == NULL){
/******************************* Ajout de l'image ********************************/
		//ajouter l'image
		$insert = $link->prepare('INSERT INTO image(code_acces_image, date_upload_image, desc_image, image_visible,
			 									mail_photographe, nom_image, id_collection, prix_ht_image)
												VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
		$insert->execute(array($codeAccesImg, $dateImport,
								$_POST['desc_image'], $img_visible,
							 	$_SESSION['login'], $_POST['nom_image'],
								$idCollection, $_POST['prix_ht_image']));

/******************************* Fin Ajout de l'image ********************************/

/******************************* Vérifications après ajout ********************************/
		//vérification ajout image
		if ($idCollection != NULL) {
			$res = $link->prepare('SELECT * FROM image WHERE code_acces_image = ? AND desc_image = ?
				 										and mail_photographe = ? and nom_image = ?
														and id_collection = ? and prix_ht_image = ?');

			$res->execute(array($codeAccesImg, $_POST['desc_image'], $_SESSION['login'],
								$_POST['nom_image'], $idCollection, $_POST['prix_ht_image']));
		} else {
			$res = $link->prepare('SELECT * FROM image WHERE code_acces_image = ? AND desc_image = ?
				 										and mail_photographe = ? and nom_image = ?
														and id_collection is ? and prix_ht_image = ?');

			$res->execute(array($codeAccesImg, $_POST['desc_image'], $_SESSION['login'],
								$_POST['nom_image'], $idCollection, $_POST['prix_ht_image']));
		}

		$dataImg = $res->fetch();

		/***********************************************************************************************************************************/
		/*************************************************** Traitements suite à ajout photo *******************************************/
		/***********************************************************************************************************************************/

		if ( count($dataImg)!= 0) {

			/**************************** Lien catégorie/image **************************************/
			$insert = $link->prepare('INSERT INTO correspondre(id_categorie, id_image)
													VALUES (?, ?)');
			$insert->execute(array($idCategorie, $dataImg[0]));
			/**************************** Fin Lien catégorie/image **************************************/

			/*************************** Traitement des tags *********************************************/
			//vérifier si tag existe
			if ($motsCles[0] != '') {
				foreach ($motsCles as $value) {
					$tag = $link->prepare('SELECT * FROM tag WHERE nom_tag = ?');

					$tag->execute(array($value));

					//si tag n'existe pas, l'ajouter
					if ($tag->fetch() == NULL) {
						$insert = $link->prepare('INSERT INTO tag(nom_tag)
																VALUES (?)');
						$insert->execute(array($value));
					}

					//récupération id tag
					$tag = $link->prepare('SELECT * FROM tag WHERE nom_tag = ?');

					$tag->execute(array($value));
					$infoTag = $tag->fetch();

					echo "id tag : ".$infoTag[0]."</br>";

					//lier img et tag
					$insert = $link->prepare('INSERT INTO referencer(id_tag, id_image)
															VALUES (?, ?)');
					$insert->execute(array($infoTag[0], $dataImg[0]));

					echo "nv col post : ".$_POST['nvCol']."</br>";
				}
			}

			/*************************** Fin Traitement des tags *********************************************/

			/***************************** Traitement nouvelle collection ********************************/
			if ($_POST['nvCol'] != '') {
				echo 'isset marche</br>';
				//vérifier si la collection existe
				$col = $link->prepare('SELECT * FROM collection WHERE nom_collection = ? and mail_photographe = ?');

				$col->execute(array($_POST['nvCol'], $_SESSION['login']));

				//Ajouter la collection si non existante
				if ($col->fetch() == NULL) {
					echo 'la collection n existe pas</br>';
					//forcer la collection visible
					$collectionVisible = true;
					$codeAccesCollection = '';

					$insert = $link->prepare('INSERT INTO collection(nom_collection, date_creation, collection_visible, code_acces_collection, mail_photographe)
															VALUES (?, ?, ?, ?, ?)');
					$insert->execute(array($_POST['nvCol'], $dateImport, $collectionVisible, $codeAccesCollection, $_SESSION['login']));

					//créer le dossier de la collection dans le dossier photographe/originale
					$nomCheminNvColOriginale = "./img/".$_SESSION['login']."/originale/".$_POST['nvCol'];
					mkdir($nomCheminNvColOriginale, 0777, true);
					//créer le dossier de la collection dans le dossier photographe/filigrane
					$nomCheminNvColFiligrane = "./img/".$_SESSION['login']."/filigrane/".$_POST['nvCol'];
					mkdir($nomCheminNvColFiligrane, 0777, true);

				}

				//récupérer l'id de la collection
				$col = $link->prepare('SELECT * FROM collection WHERE nom_collection = ? and mail_photographe = ?');

				$col->execute(array($_POST['nvCol'], $_SESSION['login']));
				$infoCol = $col->fetch();

				echo "id col : ".$infoCol[0]."</br>";
				$idCollection = $infoCol[0];

				//update de l'image avec l'ajout de la collection
				$updateImg = $link->prepare('UPDATE image SET id_collection = ? WHERE id_image = ?');

				$updateImg->execute(array($infoCol[0], $dataImg[0]));

				$nomCollection = $_POST['nvCol'];

			}
			/***************************** Fin Traitement nouvelle collection ********************************/

			/***************************** Upload de la photo ********************************/
			$maxsize = $_POST['MAX_FILE_SIZE'];
			$extensions_valides = array( 'jpg' , 'jpeg');
			//1. strrchr renvoie l'extension avec le point (« . »).
			//2. substr(chaine,1) ignore le premier caractère de chaine.
			//3. strtolower met l'extension en minuscules.
			$extension_upload = strtolower(  substr(  strrchr($_FILES['img']['name'], '.')  ,1)  );

			/*$_FILES['img']['type']     //Le type du fichier. Par exemple, cela peut être « image/png ».
			$_FILES['img']['size']     //La taille du fichier en octets.
			$_FILES['img']['tmp_name'] //L'adresse vers le fichier uploadé dans le répertoire temporaire.
			$_FILES['img']['error']    //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.
			*/

			//Contrôles image
			//if ($_FILES['img']['error'] > 0) $erreur = "Erreur lors du transfert";
			//if ($_FILES['img']['size'] > $maxsize) $erreur = "Le fichier est trop gros";

			//if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";

			if ($_FILES['img']['error'] <= 0 and $_FILES['img']['size'] <= $maxsize and in_array($extension_upload,$extensions_valides)) {
				if ($idCollection == NULL) {
					echo 'id collection null à l upload</br>';
					$nomImg = $dataImg[0];
					$cheminImgOriginale = "./img/".$_SESSION['login']."/originale/".$nomImg.".".$extension_upload;
				    $resultat = move_uploaded_file($_FILES['img']['tmp_name'],$cheminImgOriginale);
				} else {
					echo 'id collection non null à l upload</br>';
					$nomImg = $dataImg[0];
					$cheminImgOriginale = "./img/".$_SESSION['login']."/originale/".$nomCollection."/".$nomImg.".".$extension_upload;
				    $resultat = move_uploaded_file($_FILES['img']['tmp_name'],$cheminImgOriginale);
				}
			if ($resultat) echo "Transfert réussi";

			/**************************************** copier l'image avec un filigrane************************************/
			//créer le chemin vers le filigrane
			if ($idCollection == NULL) {
				echo 'id collection null au filigrane</br>';
				$cheminImgFiligrane = "./img/".$_SESSION['login']."/filigrane/".$nomImg.".".$extension_upload;
			} else {
				echo 'id collection non null au filigrane</br>';
				$cheminImgFiligrane = "./img/".$_SESSION['login']."/filigrane/".$nomCollection."/".$nomImg.".".$extension_upload;
			}
			// Chargement de l'image dans une variable
		    $img = ImageCreateFromJPEG($cheminImgOriginale);

		    // Couleur du texte au format RGB
		    $textcolor = imagecolorallocate($img, 224, 34, 34);

		    // Le texte en question
		    imagestring($img, 5, 10, 10, 'Horizon', $textcolor);

		    // Maintenant, envoyer les données de l'image
		    imagejpeg ($img, $cheminImgFiligrane, 100);

		    // Libérons la mémoire
		    imagedestroy($img);
			}
			/**************************************** Fin copier l'image avec un filigrane************************************/

			/***************************** Fin Upload de la photo ********************************/

			/**************************** update de la photo avec les liens des images *********************************************/
			$updateImg = $link->prepare('UPDATE image SET lien_image_originale = ?, lien_image_fili = ? WHERE id_image = ?');

			$updateImg->execute(array($cheminImgOriginale, $cheminImgFiligrane, $dataImg[0]));
			/**************************** update de la photo avec les liens des images *********************************************/


			header("Location: ./saisiePhoto.php?etat=importee");
		} else {
			echo 'échec import';
		}

/******************************* Fin Vérifications après ajout ********************************/


	} else {
		header("Location: ./saisiePhoto.php?etat=existe");
	}
?>
