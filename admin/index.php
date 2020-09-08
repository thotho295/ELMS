<?php
session_start();
include('includes/config.php');
if (isset($_POST['signin'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {

        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- Title -->
        <title>Management system</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">        
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
    </head>
    <body >
        <header class="mn-header navbar-fixed">
            <nav class="cyan darken-1">
                <div class="nav-wrapper row" style="background: #303030">
                    <section class="material-design-hamburger navigation-toggle">
                        <a href="#" data-activates="slide-out" class="button-collapse show-on-large material-design-hamburger__icon">
                            <span class="material-design-hamburger__layer"></span>
                        </a>
                    </section>
                    <div class="header-title col s10">      
                        <span class="chapter-title">Employee Leave Management System</span>
                    </div> 
                </div>
            </nav>
        </header>

        <div class="mn-content valign-wrapper" style="background: #B0E0E6">

            <main class="mn-inner container">
                <!--<h4 align="center"><a href="../index.php">Employee Leave Management System | Admin Login</a></h4>-->
                <div class="valign">
                    <div class="row">
                        <div class="col s12 m6 l8 offset-l3 offset-m1">
                            <div class="card white darken-1">
                                <div class="card-content ">
                                    <span class="card-title" style="font-size:20px;">Admin login</span>
                                    <div class="row">
                                        <form class="col s12" name="signin" method="post">
                                            <div class="input-field col s12">
                                                <input id="username" type="text" name="username" class="validate" autocomplete="off" required >
                                                <label for="email">Username</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="password" type="password" class="validate" name="password" autocomplete="off" required>
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="col s12 right-align m-t-sm">

                                                <input type="submit" style="background: #1698C0" name="signin" value="Sign in" class="btn">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>

    </body>
</html>