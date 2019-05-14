<?php
    // Cookie mdr
    setcookie('user','',time()-100,'/');
    setcookie('login','',time()-100,'/');
    setcookie('password','',time()-100,'/');
    setcookie('admin','',time()-100,'/');
    setcookie('firstName','',time()-100,'/');
    setcookie('lastName','',time()-100,'/');

    session_start();
    session_destroy();

    header('Location:../..');
?>
