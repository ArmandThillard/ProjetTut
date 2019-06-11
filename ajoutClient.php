<?php
	include('./inc/connection/connect_info.php');
	try {
		$link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}


	//vérifier si le client existe déjà
	$res = $link->prepare('SELECT * FROM client WHERE mail_client = ?');

	$res->execute(array($_POST['mail']));

	if ($_POST['password'] == $_POST['password2']) {
		if($res->fetch() == NULL) {
	        //ajout du photographe
			$insert = $link->prepare('INSERT INTO client(mail_client, nom_client, prenom_client,
				 									mdp_client, tel_client)
													VALUES (?, ?, ?, ?, ?)');
			$insert->execute(array($_POST['mail'], $_POST['nom'], $_POST['prenom'], $_POST['password'], $_POST['telClient']));

			//vérifier si le photographe a été ajouté
			$res = $link->prepare('SELECT * FROM client WHERE mail_client = ?');

			$res->execute(array($_POST['mail']));

			if ($res->fetch() == NULL) {
				echo 'Echec ajout client';
			} else {
				header("Location: ./inscriptionClient.php?page=ok");
			}
		} else {
			echo 'Le client existe déjà';
		}
	} else {
		header("Location: ./inscriptionClient.php?mail=".$_POST['mail']."&nom=".$_POST['nom']."&prenom=".$_POST['prenom']."&tel=".$_POST['telClient']);
	}
?>
