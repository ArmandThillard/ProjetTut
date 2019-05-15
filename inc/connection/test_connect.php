<?php
    require_once('./connect_info.php');
    session_start();
    try {
	       $link = new PDO("mysql:host=$server;dbname=$db",$login, $mdp);
    } catch(Exception $e) {
	       die('Erreur : '.$e->getMessage());
    }
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Test connection Client
	$res = $link->prepare('SELECT * FROM client WHERE mail_client = ? AND mdp_client = ?');
	$res->execute(array($login,$password));
    $data = $res->fetch();
	if ($data != NULL){
	       $_SESSION['login'] = $login;
           $_SESSION['password'] = $password;
           $user = 'U';
           $_SESSION['user'] = $user;
           $prenom =  $data['prenom_client'];
           $_SESSION['firstName'] = $prenom;
           $nom = $data['nom_client'];
           $_SESSION['lastName'] = $nom;
	}

    // Test connection Photographe
	$res = $link->prepare('SELECT * FROM photographe WHERE mail_photographe = ? AND mdp_photographe = ?');
	$res->execute(array($login,$password));
    $data = $res->fetch();
	if ($data != NULL){
	       $_SESSION['login'] = $login;
           $_SESSION['password'] = $password;
           $user = 'P';
           $_SESSION['user'] = $user;
           $prenom =  $data['prenom_photographe'];
           $_SESSION['firstName'] = $prenom;
           $nom = $data['nom_photographe'];
           $_SESSION['lastName'] = $nom;
	}

    // Test connection Admin
    $res = $link->prepare('SELECT * FROM admin WHERE login = ? AND password = ?');
	$res->execute(array($login,$password));

	if ($res->fetch() != NULL){
	       $_SESSION['login'] = $login;
           $_SESSION['password'] = $password;
           $user = 'A';
           $_SESSION['user'] = $user;
           $admin = 'Administrateur';
           $_SESSION['admin'] = $admin;
	}

    // Cookies
    $cookieExpDate = time()+(5*365*24*60*60);

    if(isset($_POST['chkCookies']) AND $_POST['chkCookies']){
        setcookie('user',$user, $cookieExpDate,'/');
        setcookie('login',$login, $cookieExpDate,'/');
        setcookie('password',$password, $cookieExpDate,'/');
        if(isset($admin)){
            setcookie('admin',$admin, $cookieExpDate,'/');
        }else{
            setcookie('firstName',$prenom, $cookieExpDate,'/');
            setcookie('lastName',$nom, $cookieExpDate,'/');
        }
    }

    header('Location:/');
?>
