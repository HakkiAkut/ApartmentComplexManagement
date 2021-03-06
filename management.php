<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION["name"])){
      header("location: index.html");
  }
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
  <title>Management</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex page-container" id="wrapper">
    <div id="page-content-wrapper" class="content-wrap">
      <nav class="navbar navbar-expand-lg navbar-light clear-div border-bottom top-nav-menu">
        <div id="logo-container">
          <a href="home-page.php" class="logo">
              Akdeniz Apartment Complex
          </a>
      </div>
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
              <a  href="#">Management</a>
            </li>
            <li class="top-nav-item dropdown-button">
              <a  href="contact/send-messages.php"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Contact <i class="fa fa-caret-down"></i>
              </a>
              <div class="dropdown-menu-right dropdown-content" aria-labelledby="navbarDropdown">
                <a href="contact/send-messages.php">suggestion</a>
                <a href="#contact">contact info</a>
              </div>
            </li>
          </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <div class="main-panel">
          <h2 style="margin-left: 20px; color: saddlebrown;">Management</h2>
          <div class="space"></div>
          <div class="management">
            <ul>
                <li>
                    <div class="management-member">
                        <h3>Director</h3>
                        <img src="img/account.png" alt="director">
                        <p>Noldo Fingolfin</p>
                    </div>
                </li>
                <li>
                    <div class="management-member">
                        <h3>Auditor</h3>
                        <img src="img/account.png" alt="director">
                        <p>Felagund Finrod</p>
                    </div>
                </li>
                <li>
                    <div class="management-member">
                        <h3>Member</h3>
                        <img src="img/account.png" alt="director">
                        <p>Thingol Elwë</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="space"></div>
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
</html>