<html>
<div class="position-sticky">
    <?php
        require("./header.php");
        require("./search.php");
    ?>
</div>
<body>

<!-- Carousel Catégories -->
<link rel="stylesheet" type="text/css" href="./style/carousel.css">
<div id="carousel-categories" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        <li data-target="#carousel-categories" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-categories" data-slide-to="1"></li>
        <li data-target="#carousel-categories" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
        <div class="item active">
            <img class="d-block" src="./img/categories/cat-animaux.jpg" alt="catégorie animaux">
            <div class="carousel-caption">
                <h3>Animaux</h3>
            </div>
        </div>
        <div class="item">
            <img class="d-block" src="./img/categories/cat-nature.jpg" alt="catégorie nature">
            <div class="carousel-caption">
                <h3>Nature</h3>
            </div>
        </div>
        <div class="item">
            <img class="d-block" src="./img/categories/cat-sport.jpg" alt="catégorie sport">
            <div class="carousel-caption">
                <h3>Sport</h3>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carousel-categories" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-categories" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

</body>
<?php
    require("./footer.php");
?>
</html>
