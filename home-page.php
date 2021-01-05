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
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,400&display=swap"
      rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400&display=swap"
      rel="stylesheet">
  <title>Home Page</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
    if(!isset($_SESSION["name"])){
        header("location: index.html");
    }
    ?>
  <div class="d-flex page-container" id="wrapper">
    <div class="border-right left-panel" id="sidebar-wrapper">
      <div class="sidebar-heading">Home</div>
      <div class="list-group list-group-flush">
        <a href="announcements.php" class="list-group-item list-group-item-action ">Announcements</a>
        <a href="document/dues.php" class="list-group-item list-group-item-action ">Dues</a>
        <a href="document/expense-income-list.php" class="list-group-item list-group-item-action ">Expense/Income</a>
        <a href="management.php" class="list-group-item list-group-item-action ">Management</a>
        <a href="contact.php" class="list-group-item list-group-item-action ">Contact</a>
        <form action="logout.php" method="post">
            <input type="submit" style="color:#7EA172;" id="logout" value="Log out" name="logout"></input>
        </form>
      </div>
    </div>
    <div id="page-content-wrapper" class="content-wrap">

      <nav class="navbar navbar-expand-lg navbar-light clear-div border-bottom top-nav-menu">
        <button style="background-color: rgb(143, 75, 58);border: saddlebrown;" class="btn btn-primary" id="menu-toggle"><i class="fa fa-caret-right"></i></button>
        <div id="logo-container">
          <a href="home-page.php" class="logo">
              Akdeniz Apartment Complex
          </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="top-nav-item">
              <a  href="announcements.php">Announcements</a>
            </li>
            <li class="top-nav-item">
              <a  href="document/dues.php">Documents</a>
            </li>
            <li class="top-nav-item">
                <?php
                    if($_SESSION["authority"]==1){
                      echo '<a href="admin-panel/add-resident.php" class="top-nav-link">Admin</a>';
                    }
                ?>
              </li>
            <li class="top-nav-item">
              <a  href="management.html">Management</a>
            </li>
            <li class="top-nav-item dropdown-button">
              <a  href="contact.php"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Contact <i class="fa fa-caret-down"></i>
              </a>
              <div class="dropdown-menu-right dropdown-content" aria-labelledby="navbarDropdown">
                <a href="contact.php">suggestion</a>
                <a href="#contact">contact info</a>
              </div>
            </li>
          </li>
          </ul>
        </div>
      </nav>
      <div class="container-fluid">
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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
</body>
</html>