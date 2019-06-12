<?php
    // Chargement de l'image dans une variable
    $fili = ImageCreateFromPNG('./img/watermark.png');
    $img = ImageCreateFromJPEG('./img/basket.jpg');


    // Couleur du texte au format RGB
    imagecopy($img, $fili, 0, 0, 0, 0, imagesx($fili), imagesy($fili));
    // Le texte en question


    // Maintenant, envoyer les données de l'image
    imagejpeg ($img, './img/1.jpg', 100);

    // Libérons la mémoire
    imagedestroy($img);
 ?>
