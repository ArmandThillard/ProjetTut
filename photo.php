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
    <?php
        include('./inc/connection/connect_info.php');
        try {
            $link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
        } catch(Exception $e) {
            die('Erreur : '.$e->getMessage());
        }

        //récupérer les infos sur la photo
        $res = $link->prepare('SELECT * FROM image WHERE id_image = ?');
		$res->execute(array($_GET['id']));

        $donneesImages = $res->fetch();

        $dimensionsImg = getimagesize($donneesImages[9]);

        if($dimensionsImg[0] > $dimensionsImg[1]) {

        }

    ?>

    <div class="row">
        <div class="col-6" style="outline : dashed red; height : 50vh;">
            <?php
                if($dimensionsImg[0] > $dimensionsImg[1] or $dimensionsImg[0] == $dimensionsImg[1]) {
                    echo "<img class='img-fluid gallery-image' src='.$donneesImages[9].' style=' height : 100%;'>";
                } else {
                    echo "<img class='img-fluid gallery-image' src='.$donneesImages[9].' style=' width : 100%;'>";
                }
            ?>
        </div>
        <div class="col-6" style="outline : dashed red;">
            <div class="container text-center">
        		<h1>Title</h1></br>
        		<form  method=post action="#">
        			<div class="form-group row">
        				<label class="col-sm-1 col-form-label col-sm-offset-2">Label</label>
        				<div class="col-sm-4 col-sm-offset-1">
        					<input name='#' type=text class="form-control " />
        				</div>
        			</div>
        			<div class="form-group row">
        				<label class="col-sm-1 col-form-label col-sm-offset-2">Label </label>
        				<div class="col-sm-4 col-sm-offset-1">
        					<input class="form-control" name='#' type=text />
        				</div>
        			</div>

        			<button type=submit class="btn btn-success" name="submit">Envoyer</>

        		</form>
            <div class="text-justify">
                <ul class="">
                    <li><label><?php echo $donneesImages[1]; ?></label></li>
                    <li><label><?php echo $donneesImages[3]; ?></label></li>
                </ul>
            </div>
        </div>
    </div>



</body>
<?php
    require('./footer.php');
?>
</html>
