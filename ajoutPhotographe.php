<?php
	include('./inc/connection/connect_info.php');
	try {
		$link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	//vérifier si le photographe existe déjà
	$res = $link->prepare('SELECT * FROM photographe WHERE mail_photographe = ? and num_siret = ?');

	$res->execute(array($_POST['adresseMail'], $_POST['numSiret']));


    if($res->fetch() == NULL) {

        //ajout du photographe
		$insert = $link->prepare('INSERT INTO photographe(mail_photographe, nom_entreprise, num_siret, nom_photographe, prenom_photographe,
			 									tel_photographe, rib_photographe, adresse_photographe, CP_photographe, ville_photographe, mdp_photographe)
												VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$insert->execute(array($_POST['adresseMail'], $_POST['nomEntreprise'],
						$_POST['numSiret'], $_POST['nomPhotographe'],
					 	$_POST['prenomPhotographe'], $_POST['telPhotographe'], $_POST['rib'],
						$_POST['adresseEntreprise'], $_POST['cpEntreprise'], $_POST['villeEntreprise'], $_POST['password']));

		//vérifier si le photographe a été ajouté
		echo $_POST['adresseMail'].'</br>';
		echo $_POST['numSiret'].'</br>';

		$res = $link->prepare('SELECT * FROM photographe WHERE mail_photographe = ? and num_siret = ?');

		$res->execute(array($_POST['adresseMail'], $_POST['numSiret']));

		if ($res->fetch() == NULL) {
			echo 'Echec ajout photographe';
		} else {
			echo 'Compte créé';
			//créer le répertoire de base
			$nomChemin = "./img/".$_POST['adresseMail'];
			mkdir($nomChemin, 0777, true);
		}
	} else {
		echo 'Le photographe existe déjà';
	}





	echo "</br>";
	echo "<a href='/inscriptionPhotographe.php'>Retour</a>";
?>
