<?php
include 'conn.php';
session_start(); //declare a session start here to use session variable in all pages
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>

    <link rel="shortcut icon" type="image/png" href="assets/icons/BLOG.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- boostrap5.1 -->
    <link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/blog/assets/bootstrap/css/bootstrap.min.css">
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/blog/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!--DATATABLES-->
    <link href="assets/datatables/css/datatables.min.css" rel="stylesheet">

    <!--JQUERY-->
    <script src="assets/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/jquery/jquery.print.js"></script>
</head>

<body>
    <div class="container-fluid">
        <!-- navbar start -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <?php
                            if (isset($index_page)) {
                                echo '<a class="nav-link" aria-current="page" href="index.php"><b>Home</b></a>';
                            } else {
                                echo '<a class="nav-link" aria-current="page" href="index.php">Home</a>';
                            }
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php 
                                if (isset($_SESSION['logged_in'])) {
                                    if (isset($blog_page)) {
                                        echo '<a class="nav-link" href="blogs.php"><b>Blogs</b></a>';
                                    } else {
                                        echo '<a class="nav-link" href="blogs.php">Blogs</a>';
                                    } 
                                }
                             ?>
                        </li>
                        <li class="nav-item">
                            <?php 
                                if (isset($about_page)) {
                                    echo '<a class="nav-link" href="about.php"><b>About</b></a>';
                                } else {
                                    echo '<a class="nav-link" href="about.php">About</a>';
                                }
                             ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION['logged_in'])) {
                                echo '<a class="nav-link" href="logout.php">Logout</a>';
                            } else { ?>
                                <?php
                                if (isset($login_page)) {
                                    echo '<a class="nav-link" href="login.php"><b>Login</b></a>';
                                } else {
                                    echo '<a class="nav-link" href="login.php">Login</a>';
                                }
                                ?>


                        </li>
                        <li class="nav-item">
                            <?php
                                if (isset($register_page)) {
                                    echo '<a class="nav-link" href="register.php"><b>Register</b></a>';
                                } else {
                                    echo '<a class="nav-link" href="register.php">Register</a>';
                                }
                            ?>
                        <?php } ?>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline" type="submit"><i class="fa fa-search" style="color:white;"></i></button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- navbar end -->