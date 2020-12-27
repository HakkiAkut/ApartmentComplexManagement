<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Apartment Complex Web Page">
    <meta name="keywords" content="Apartment Complex Web Page, Apartment Complex Manager">
    <meta name="description" content="a web site for the management of an apartment complex">
    <meta name="author" content="Hakkı Can Akut">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <title>Home Page</title>
</head>
<body>
    <?php
    if(!isset($_SESSION["name"])){
        header("location: index.html");
    }
    ?>
    <div id="page-container">
        <div id="content-wrap">
            <nav>
                <div class="container clear-div">
                    <div id="logo-container">
                        <a href="home-page.php" class="logo">
                            Akdeniz Apartment Complex
                        </a>
                    </div>
                    <div id="top-nav-menu">
                        <ul>
                            <li class="top-nav-item">
                                <a href="announcements.html" class="top-nav-link">Announcements</a>
                            </li>
                            <li class="top-nav-item">
                                <a href="management.html" class="top-nav-link">Management</a>
                            </li>
                            <li class="top-nav-item">
                                <a href="document.html" class="top-nav-link">Documents</a>
                            </li>
                            <li class="top-nav-item">
                                <?php
                                    if($_SESSION["authority"]==1){
                                        echo '<a href="admin-panel/add-resident.php" class="top-nav-link">Admin</a>';
                                    }
                                ?>
                            </li>
                            <li class="top-nav-item">
                                <div class="dropdown-button">
                                    <button class="dropdown-item">Contact
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-content">
                                        <a href="contact.html">suggestion</a>
                                        <a href="#contact">contact info</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="space"></div>
            <div class="container clear-div">
                <div class="left-panel" >
                    <h2 style="margin-left: 40px; color: saddlebrown;">Announcments</h2>
                    <ul>
                        <li>
                            <a href="announcements.html">
                                <p class="left-title">
                                    Meeting
                                </p>
                                
                                <p class="left-subtitle">
                                    There would be a meeting on 10/11/2020
                                </p>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="announce.html">
                                <p class="left-title">
                                    Announcement B
                                </p>
                                
                                <p class="left-subtitle">
                                    subtitle of Announcement B
                                </p>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="announce.html">
                                <p class="left-title">
                                    Announcement C
                                </p>
                                
                                <p class="left-subtitle">
                                    subtitle of Announcement C
                                </p>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="announce.html">
                                <p class="left-title">
                                    Announcement D
                                </p>
                                
                                <p class="left-subtitle">
                                    subtitle of Announcement D
                                </p>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="announce.html">
                                <p class="left-title">
                                    Announcement E
                                </p>
                                
                                <p class="left-subtitle">
                                    subtitle of Announcement E
                                </p>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="announce.html">
                                <p class="left-title">
                                    Announcement F
                                </p>
                                
                                <p class="left-subtitle">
                                    subtitle of Announcement F
                                </p>
                            </a>
                        </li>
                        <hr>
                    </ul>
                    <form action="logout.php" method="post">
                        <input type="submit" style="color:#7EA172;" id="logout" value="Log out" name="logout"></input>
                    </form>
                </div>
                <div class="main-panel">
                    <h2 style="margin-left: 20px; color: saddlebrown;">Gallery</h2>
                    <div class="space"></div>
                    <div class="slides">
                        <div>
                          <img src="img/image1.jpg" alt="">
                        </div>
                        <div>
                          <img src="img/image2.jpg" alt="">
                        </div>
                        <div>
                          <img src="img/image3.jpg" alt="">
                        </div>
                        <div>
                          <img src="img/image4.jpg" alt="">
                        </div>
                      </div>
                </div>
            </div>
            <div class="space"></div>
        </div>
            <footer>
            <div class="container clear-div" id="contact">
                <ul>
                    <li>
                        <div class="col">
                            <h4>Location</h4>
                            <p>
                                A Mahallesi, B Caddesi, Akdeniz Sitesi, Türkiye/Antalya
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="col">
                            <h4>Email</h4>
                            <p>
                                akdeniz@apartment.com
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="col">
                            <h4>
                                Phone Number
                            </h4>
                            <p>
                                +0(222) 222 2222
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
            </footer>
    </div>
</body>
