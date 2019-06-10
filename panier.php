<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org.TR.html4/loose.dtd">
<html>
<head>
	<meta charset="utf-8" />
      <title>Mon panier</title>
</head>
<?php
    require('./header.php');
?>
	<link rel="stylesheet" type="text/css" href="./style/tmp.css?id=v2">
<body>
    <?php
    	include('./inc/connection/connect_info.php');
    	try {
    		$link = new PDO("mysql:host=$server;dbname=$db;charset=utf8",$login, $mdp);
    	} catch(Exception $e) {
    		die('Erreur : '.$e->getMessage());
    	}

		$res = $link->prepare('SELECT * FROM acheter where mail_client = ?');

	    $res->execute(array($_COOKIE['login']));

    	if($res->rowCount() != 0){
    		echo "<div class='container col-sm-10 text-center mt-5'>
                    <h1> Mon Panier </h1>
                    <table class='table table-image mt-5'>
                        <tr>
                            <th>Photo</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Support</th>
                            <th>Prix (€)</th>
            				<th>Quantité</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>";
    		while($infosAchat = $res->fetch()){

                //récupérer l'image
                $image = $link->prepare('SELECT * FROM image where id_image = ?');
                $image -> execute(array($infosAchat['id_image']));

                $infosImage = $image->fetch();
                $cheminimg = $infosImage['lien_image'];

                //récupérer le support
                $support = $link->prepare('SELECT * FROM support where id_support = ?');
                $support -> execute(array($infosAchat['id_support']));

                $infosSupport = $support->fetch();

                $prixCommandeTTC = ($infosImage['prix_ht_image']*1.2 + $infosSupport['prix_ht_support']*1.2)*$infosAchat['quantite'];
    ?>

    			<tr>
                    <td class="w-25">
                        <a href="./photo.php?id=<?php echo $infosImage['id_image']; ?>.">
                            <img class="img-fluid img-thumbnail" src="<?php echo $infosImage['lien_image']; ?>" style="height : 100px"/>
                        </a>
                    </td>
                    <td><?php echo $infosImage['nom_image']; ?></td><td class='text-left'><?php echo $infosImage['desc_image']; ?></td>
                    <td><?php echo $infosSupport['type_support']; ?></td><td><?php echo $prixCommandeTTC; ?></td>
                    <td>
                        <form class="form-group" method="POST" action="./modifPanier.php?idS=<?php echo $infosSupport['id_support']; ?>&idI=<?php echo $infosImage['id_image']; ?>">
                            <input class="form-control" name="qte" value="<?php echo $infosAchat['quantite']; ?>"/>
                    </td>
                    <td>
                            <button class="btn" type="submit">Modifier</button>
                        </form>
                    </td>
                    <td>
                        <button class="btn btn-danger" type="button" onclick="window.location.href='./supprPanier.php?idS=<?php echo $infosSupport['id_support']; ?>&idI=<?php echo $infosImage['id_image']; ?>'">&times;</button>
                    </td>
                </tr>
            </div>
    <?php
                }
    	}else{
            echo "<div class='text-center'>
                    <h1 class='text-center' style=' margin-top : 20vh; margin-bottom : 10vh;'>Vous n'avez pas encore enregitré d'article...</h1>
                    <button type=button class='btn col-sm-1 mr-5' onclick=window.location.href='./index.php'>Page d'accueil</button>
                </div>";
    	}
    ?>

</body>
<?php
    require('./footer.php');
?>
</html>
