<?php
	require('./header.php');
	include('./inc/connection/connect_info.php');
	try {
		$link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	//vérifier si le photographe existe déjà
	$res = $link->prepare('SELECT * FROM photographe WHERE mail_photographe = ? and num_siret = ?');

	$res->execute(array($_POST['adresseMail'], $_POST['numSiret']));

	if ($_POST['password'] == $_POST['confPassword']) {
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

				//créer le répertoire de base
				$nomCheminOriginale = "./img/".$_POST['adresseMail']."/originale";
				$nomCheminFiligramme = "./img/".$_POST['adresseMail']."/filigramme";
				mkdir($nomCheminOriginale, 0777, true);
				mkdir($nomCheminFiligramme, 0777, true);

				header("Location: ./inscriptionPhotographe.php?page=ok");
			}
		} else {
			echo 'Le photographe existe déjà';
		}
	} else {

		$tab = [];

		array_push($tab, $_POST['adresseMail']);
		array_push($tab, $_POST['nomPhotographe']);
		array_push($tab, $_POST['prenomPhotographe']);
		array_push($tab, $_POST['telPhotographe']);

		array_push($tab, $_POST['nomEntreprise']);
		array_push($tab, $_POST['numSiret']);
		array_push($tab, $_POST['rib']);
		array_push($tab, $_POST['adresseEntreprise']);
		array_push($tab, $_POST['cpEntreprise']);
		array_push($tab, $_POST['villeEntreprise']);
		array_push($tab, $_POST['telEntreprise']);

		$tab = serialize($tab);

		header("Location: ./inscriptionPhotographe.php?tab=".$tab);
	}
?>
