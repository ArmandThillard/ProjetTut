<!--Header start-->
<header>

    <!-- Call for Bootstrap, JQuery-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <?php
        session_start();
        // Set session values from cookies if there are any
        if(isset($_COOKIE['login'])){
            $_SESSION['user'] = $_COOKIE["user"];
            $_SESSION['login'] = $_COOKIE['login'];
            $_SESSION['password'] = $_COOKIE['password'];
            if($_SESSION['user'] == 'A'){
                $_SESSION['admin'] = $_COOKIE['admin'];
            }else{
                $_SESSION['firstName'] = $_COOKIE['firstName'];
                $_SESSION['lastName'] = $_COOKIE['lastName'];
            }
        }
    ?>
    <!-- Navbar -->
    <div class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/"> New Horizon </a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if (!isset($_SESSION['login']) AND !isset($_COOKIE['login'])){
                ?>
                <li><a class="text-primary" href="./register.php">Sign Up</a></li>
                <li><a href="./login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>
                <?php
                    }else{
                ?>
                <li><a href="/monCompte.php"><span class="glyphicon glyphicon-user"></span>
                    <?php
                        if($_SESSION['user'] == 'A'){
                            echo $_SESSION['admin'];
                        }else{
                            echo $_SESSION['firstName']." ".$_SESSION['lastName'];
                        }
                    ?>
                </a></li>
                <button class="btn btn-danger navbar-btn" onClick="window.location='./inc/connection/disconnect.php';">Se déconnecter</button>
                    <?php
                        }
                    ?>

            </ul>
        </div>
    </div>
</header>
