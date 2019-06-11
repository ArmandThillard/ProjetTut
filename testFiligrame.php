<?php
    // Chargement de l'image dans une variable
    $img = ImageCreateFromJPEG('./img/hugo@gmail.com/51.jpg');

    // Couleur du texte au format RGB
    $textcolor = imagecolorallocate($img, 224, 34, 34);

    // Le texte en question
    imagestring($img, 5, 10, 10, 'Lean', $textcolor);

    // Un header spécifique
    header('Content-type: image/jpeg');

    // Maintenant, envoyer les données de l'image
    imagejpeg ($img, './img/hugo@gmail.com/testCol3/51.jpg', 100);

    // Libérons la mémoire
    imagedestroy($img);
 ?>
