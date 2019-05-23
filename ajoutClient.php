<?php
	include('./inc/connection/connect_info.php');
	try {
		$link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}


	//vérifier si le photographe existe déjà
	$res = $link->prepare('SELECT * FROM client WHERE mail_client = ?');

	$res->execute(array($_POST['mail']));


    if($res->fetch() == NULL) {
        //ajout du photographe
		$insert = $link->prepare('INSERT INTO client(mail_client, nom_client, prenom_client,
			 									mdp_client, tel_client)
												VALUES (?, ?, ?, ?, ?)');
		$insert->execute(array($_POST['mail'], $_POST['nom'], $_POST['prenom'], $_POST['password'], $_POST['telClient']));

		//vérifier si le photographe a été ajouté
		echo $_POST['adresseMail'].'</br>';

		$res = $link->prepare('SELECT * FROM client WHERE mail_client = ?');

		$res->execute(array($_POST['adresseMail']));

		if ($res->fetch() == NULL) {
			echo 'Echec ajout client';
		} else {
			echo 'Compte créé';
		}
	} else {
		echo 'Le client existe déjà';
	}





	echo "</br>";
	echo "<a href='/inscriptionClient.php'>Retour</a>";
?>
