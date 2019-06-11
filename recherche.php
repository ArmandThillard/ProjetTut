<?php
    require("./header.php");
    require("./search.php");
    require_once('./inc/connection/connect_info.php');
    try {
           $link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
    } catch(Exception $e) {
           die('Erreur : '.$e->getMessage());
    }
    if(!isset($_GET['search'])){
        $_GET['search'] = '';
    }
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-3 tri">
            <div id="prix" class="filters rounded">
                <h2 class="font-weight-bold text-center"><small>Trier par prix</small></h2>
                <label>Min</label><input name="prix-min" type="number" form="searchForm"> - <input name="prix-max" type="number" form="searchForm"><label>Max</label>
            </div>

            <div id="categories" class="filters rounded">
                <h2 class="font-weight-bold text-center"><small>Catégories</small></h2>
                <?php
                    $res = $link->query("SELECT id_categorie, nom_categorie FROM categorie");
                    while($data = $res->fetch()){
                        echo "<input type='checkbox' form='searchForm' name='cat' value=".$data['nom_categorie']." ><label>".ucfirst($data['nom_categorie'])."</label></br>";
                    }
                ?>
            </div>
        </div>
        <div id="searchedImages" class="col-9">
            <h1 class="font-weight-bold text-light"><small> Résultats de la recherche pour : <?=$_GET['search']?> </small></h1>
            <?php
                if(!isset($_GET['search'])){
                    $_GET['search'] = '';
                }
                $_GET['search'] = strtolower($_GET['search']);
                $search = explode(' ',$_GET['search']);
                $requete = 'SELECT image.id_image id, image.lien_image_fili lien FROM image, tag, referencer, correspondre WHERE image.id_image = referencer.id_image
                                AND tag.id_tag = referencer.id_tag AND image.id_image = correspondre.id_image AND ';
                //recherche des mots-clés dans : TAGS, NOM_IMAGE
                $requete = $requete.'(';
                for($i = 0; $i < count($search); $i++){
                    $requete = $requete."(tag.nom_tag LIKE '%".$search[$i]."%' OR image.nom_image LIKE '%".$search[$i]."%')";
                    if($i<count($search) - 1){
                        $requete = $requete." OR";
                    }else{
                        $requete = $requete.")";
                    }
                }
                // Insertion du prix si renseigné
                if(isset($_GET['prix-min']) && !empty($_GET['prix-min'])){
                    $requete = $requete." AND image.prix_ht_image >= ".$_GET['prix-min'];
                }
                if(isset($_GET['prix-max']) && !empty($_GET['prix-min'])){
                    $requete = $requete." AND image.prix_ht_image <= ".$_GET['prix-max'];
                }
                // Insertion des catégories si cochées
                $res = $link->query("SELECT id_categorie FROM categorie");
                while($data = $res->fetch()){
                    if(isset($_GET[$data['id_categorie']])){
                        $requete = $requete." AND correspondre.id_categorie = ".$data['id_categorie'];
                    }
                }

                // Images visibles uniquement
                $requete = $requete." AND image.image_visible = 1";
                // De la plus récente à la plus ancienne
                $requete = $requete." ORDER BY image.date_upload_image DESC";
                echo $requete;
                $res = $link->query($requete);
                $nbImages = 0;
                echo '<div class="row">';
                while($data = $res->fetch()){
                    if($nbImages % 3 == 0){
                        echo '</div><div class="row">';
                    }
                    ?>
                        <div class="col-4">
                            <?php
                            echo '<a href="./photo.php?id='.$data['id'].'"><img class="img-fluid gallery-image" src="'.$data['lien'].'"></a>';
                            $nbImages++;
                            ?>
                        </div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
    require('./footer.php');
?>
