<?php
    $tab = ['tatataa5', 5, 'lol'];
    if(isset($_GET['submit'])) {
        echo unserialize($_GET['le'])[0];
    }

    echo serialize($tab);
 ?>

<form method="get" action="">
    <input name="le" type="text">
        <input name="submit" type="submit">
</form>
