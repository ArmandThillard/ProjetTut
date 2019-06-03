<?php
    require("./header.php");
    require("./search.php");
    require_once('./inc/connection/connect_info.php');
    try {
           $link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
    } catch(Exception $e) {
           die('Erreur : '.$e->getMessage());
    }
?>
<div class="container-fluid">
    <div class="row">
        <div id="filters" class="col-2">
            <div id="prix">
                <label>Min</label><input name="prix-min" type="number"> - <label>Max</label><input name="prix-max" type="number">
            </div>

            <div id="categories">
                <?php
                    $res = $link->query("SELECT id_categorie, nom_categorie FROM categorie");
                    while($data = $res->fetch()){
                        echo "<input type='checkbox' name=".$data['id_categorie']."value=".$data['nom_categorie']." ><label>".ucfirst($data['nom_categorie'])."</label>";
                    }
                ?>
            </div>
        </div>
        <div id="searchedImages" class="col-10">
            <?php
                $search = explode(' ',$_GET['search']);
                $requete = 'SELECT lien_image FROM image, tag, referencer WHERE image.id_image = referencer.id_image AND tag.id_tag = referencer.id_tag AND ';
                //recherche des mots-clés
                $requete = $requete.'(';
                for($i = 0; $i < count($search); $i++){
                    $requete = $requete."(tag.nom_tag LIKE '%".$search[$i]."%' OR image.nom_image LIKE '%".$search[$i]."%')";
                    if($i<count($search) - 1){
                        $requete = $requete." OR";
                    }else{
                        $requete = $requete.")";
                    }
                }
                echo $requete;

                $res = $link->query($requete);
                if($res->fetch() != NULL){
                    while($data = $res->fetch()){
                        echo '<img class="img-fluid" src="'.$data['lien_image'].'">';
                    }
                }
            ?>
        </div>
    </div>
</div>
<?php
    require('./footer.php');
?>
