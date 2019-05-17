<?php
	include('./inc/connection/connect_info.php');
	try {
		$link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	//récupérer civilité
	if(isset($_POST['homme'])) {
        $civilite = 'M';
    } elseif ($_POST['femme']) {
        $civilite = 'Mme';
    } else {
        $civilite = '';
    }

	//vérifier si le photographe existe déjà
	$res = $link->prepare('SELECT * FROM photoraphe WHERE mail_photographe = ? and num_siret = ?');

	$res->execute(array($_POST['adresseMail'], $_POST['numSiret']));

    if($res->fetch() == NULL) {
        //ajouter l'image
		$insert = $link->prepare('INSERT INTO photographe(mail_photographe, nom_entreprise, num_siret, nom_photographe, prenom_photographe,
			 									tel_photographe, IBAN_photographe, adresse_photographe, CP_photographe, ville_photographe)
												VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$insert->execute(array($_POST['adresseMail'], $_POST['nomEntreprise'],
						$_POST['numSiret'], $_POST['nomPhotographe'],
					 	$_POST['prenomPhotographe'], $_POST['telPhotographe'], $_POST['iban'],
						$_POST['adresseEntreprise'], $_POST['cpEntreprise'], $_POST['villeEntreprise']));
    }

	//vérifier si le photographe a été ajouté
	$res = $link->prepare('SELECT * FROM photoraphe WHERE mail_photographe = ? and num_siret = ?');

	$res->execute(array($_POST['adresseMail'], $_POST['numSiret']));

	if ($res->fetch() == NULL) {
		echo 'Echec ajout photographe';
	} else {
		echo 'Compte créé';
	}



	echo "</br>";
	echo "<a href='/saisiePhoto.php'>Retour</a>";
?>
