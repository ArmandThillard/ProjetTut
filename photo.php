<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org.TR.html4/loose.dtd">
<html>
<head>
	<meta charset="utf-8" />
      <title>Visionnage photo</title>
</head>
<?php
    require('./header.php');
    require('./search.php');
?>
<body>

	<?php if (isset($_GET['page'])) {?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#myModal").modal('show');
			});
		</script>
		<div id="myModal" class="modal fade" style="color:black;">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
						<h4 class="modal-title">Félicitations!</h4>
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		            </div>
		            <div class="modal-body">
						<p>Vos articles ont bien été ajoutés à votre panier!</p>
						<p>Voulez-vous continuer vos recherches?</p>
		            </div>
					<div class="modal-footer">
						<button type="button" class="btn" onclick="window.location.href='./recherche.php'">Continuer</button>
						<button type="button" class="btn btn-primary" onclick="window.location.href='./panier.php'">Aller au panier</button>
					</div>
		        </div>
		    </div>
		</div>
	<?php } ?>

    <?php
        include('./inc/connection/connect_info.php');
        try {
            $link = new PDO("mysql:host=$server;dbname=$db;charset=utf8",$login, $mdp);
        } catch(Exception $e) {
            die('Erreur : '.$e->getMessage());
        }

        //récupérer les infos sur la photo
        $res = $link->prepare('SELECT * FROM image WHERE id_image = ?');
		$res->execute(array($_GET['id']));

        $donneesImages = $res->fetch();

		$prixImgTTC = $donneesImages['prix_ht_image']*1.2;

    ?>

    <div class="row">
        <div class="col-6" style="height : 50vh;">
			<img class='img-fluid img-detail' src=<?php echo $donneesImages[10]; ?> style=' height : 100%;'>
        </div>
        <div class="col-6">
            <div class="container text-left">
        		<form class="mt-5"  method=post action="./ajoutPanier.php?id=<?php echo $donneesImages['id_image']; ?>">
        			<div class="form-group text-left row">
        				<label class="col-10  font-weight-bold h2"><?php echo $donneesImages[1]; ?></label>
        			</div>
					<div class="form-group text-left row">
        				<label class="col-10 col-form-label"><?php echo $donneesImages[3]; ?></label>
        			</div>
					<div class="form-group row">
						<label class="col-sm-1 col-form-label">Prix </label>
						<div class="col-sm-1 col-sm-offset-1">
							<label class="col-form-label" name='prixImgTTC' type=text ><?php echo round($prixImgTTC.'€', 2); ?></label>
						</div>
					</div>
        			<div class="form-group row">
        				<label class="col-sm-1 col-form-label ">Quantité </label>
        				<div class="col-sm-1 col-sm-offset-1">
        					<input class="form-control" name='qte' type=text value="1"/>
        				</div>
        			</div>
					<?php
						include('./inc/connection/connect_info.php');
						try {
							$link = new PDO("mysql:host=$server;dbname=$db;charset=utf8",$login, $mdp);
						} catch(Exception $e) {
							die('Erreur : '.$e->getMessage());
						}

						//Liste déroulante pour le choix des catégories
						$res = $link->prepare('SELECT * FROM support');

						$res->execute(array());

						if($res->rowCount() != 0){
							echo "<div class='form-group row'>
									<label class='col-sm-1 col-form-label'>Support</label>
									<div class='col-sm-3'>
										<select name='support' class='form-control custom-select' id='inputGroupSelect01'/>";
										while($dataSup =  $res->fetch()){
											$prixTTC = $dataSup['prix_ht_support']*1.20;
											if ($dataSup['type_support'] == 'Papier photo') {
												echo "<option selected>".$dataSup['type_support'].' - '.$prixTTC.'€';
											} else {
												echo "<option>".$dataSup['type_support'].' - '.$prixTTC.'€';
											}
										}
								        echo "	</select>
									</div>
								</div>";
						} else {
							echo 'Support : Aucune support disponible';
						}

						//désactiver le bouton submit si non connecté
						if (!isset($_SESSION['login'])) {
							echo "<button type=submit class='btn btn-success' name='submit' disabled>Ajouter au panier</button>";
						} else {
							echo "<button type=submit class='btn btn-success' name='submit'>Ajouter au panier</button>";
						}

						?>
        		</form>
        </div>
    </div>
	<!--Modal-->
	<div class="modal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>Modal body text goes here.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>
</body>
<?php
    require('./footer.php');
?>
</html>
