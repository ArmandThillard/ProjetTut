<html>
<div class="position-sticky">
    <?php
        require("./header.php");
        require("./search.php");
        require_once('./inc/connection/connect_info.php');
        try {
               $link = new PDO("mysql:host=$server;dbname=$db;charset=utf8",$login, $mdp);
        } catch(Exception $e) {
               die('Erreur : '.$e->getMessage());
        }
    ?>
</div>
<body>

<!-- Carousel Catégories -->
<link rel="stylesheet" type="text/css" href="./style/carousel.css">
<div id="carousel-container" class="d-block">
    <div id="carousel-categories" class="carousel slide mx-auto" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#carousel-categories" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-categories" data-slide-to="1"></li>
            <li data-target="#carousel-categories" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            <?php
                $res = $link->query('SELECT image.lien_image_fili lien, categorie.nom_categorie cat
                                FROM image, correspondre, categorie
                                WHERE image.id_image = correspondre.id_image AND
                                        correspondre.id_categorie = categorie.id_categorie
                                GROUP BY categorie.id_categorie
                                ORDER BY image.date_upload_image DESC');
                $nbImages = 0;
                while($data = $res->fetch()){
                    if($nbImages == 0){?>
                        <div class="carousel-item active">
                        <div class="row"><?php
                    }else{
                        if($nbImages % 3 == 0){?>
                            </div>
                            </div>
                            <div class="carousel-item">
                            <div class="row"><?php
                        }
                    }?>
                    <div class="col">
                        <a href="./recherche.php?cat=<?=$data['cat']?>">
                            <img class="img-fluid" src="<?=$data['lien'];?>" alt="catégorie <?=$data['cat'];?>">

                        <div class="carousel-caption">
                            <h3><span><?=ucfirst($data['cat']);?></span></h3>
                        </div>
                        </a>
                    </div>
            <?php
                    $nbImages++;
                }
            ?>
        </div></div>
        </div>
            <!--
            <div class="carousel-item active">
                <div class="row">
                    <div class="col">
                        <img class="img-fluid" src="./img/categories/cat-animaux.jpg" alt="catégorie animaux">
                        <div class="carousel-caption">
                            <h3><span>Animaux</span></h3>
                        </div>
                    </div>
                    <div class="col">
                        <img class="img-fluid" src="./img/categories/cat-nature.jpg" alt="catégorie nature">
                        <div class="carousel-caption">
                            <h3><span>Nature</span></h3>
                        </div>
                    </div>
                    <div class="col">
                        <img class="img-fluid" src="./img/categories/cat-sport.jpg" alt="catégorie sport">
                        <div class="carousel-caption">
                            <h3><span>Sport</span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col">
                        <img class="img-fluid" src="./img/categories/cat-mariage.jpg" alt="catégorie mariage">
                        <div class="carousel-caption">
                            <h3><span>Mariage</span></h3>
                        </div>
                    </div>
                    <div class="col">
                        <img class="img-fluid" src="./img/categories/cat-musique.jpg" alt="catégorie musique">
                        <div class="carousel-caption">
                            <h3><span>Musique</span></h3>
                        </div>
                    </div>
                    <div class="col">
                        <img class="img-fluid" src="./img/categories/cat-technologie.jpg" alt="catégorie technologie">
                        <div class="carousel-caption">
                            <h3><span>Technologie</span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->
        <a class="carousel-control-prev" href="#carousel-categories" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-categories" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

</body>
<?php
    require("./footer.php");
?>
</html>
