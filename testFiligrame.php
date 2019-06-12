<?php
    // Chargement de l'image dans une variable
    $img = ImageCreateFromJPEG('./img/hugophoto@gmail.com/athlétisme.jpg');

    // Couleur du texte au format RGB
    $textcolor = imagecolorallocate($img, 224, 34, 34);

    echo

    // Le texte en question
    imagestring($img, 2, 10, 10, 'Lean', $textcolor);


    // Maintenant, envoyer les données de l'image
    imagejpeg ($img, './img/hugophoto@gmail.com/2.jpg', 100);

    // Libérons la mémoire
    imagedestroy($img);
 ?>
