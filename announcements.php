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
  <title>Announcements</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex page-container" id="wrapper">
    <div class="border-right left-panel" id="sidebar-wrapper">
      <div class="sidebar-heading">Announce</div>
      <div class="list-group list-group-flush">
        <?php
        $conn = new mysqli("localhost", "root", "1234","web20");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $sql="SELECT * FROM announcements ORDER BY id DESC LIMIT 10";
          $result=$conn->query($sql);
          if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
              $topic=$row['topic'];
              $id=$row['id'];
              echo'<a href="announcements.php?announce='.$id.'" class="list-group-item list-group-item-action ">'.$topic.'</a>';
            }
          }

        ?>
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
              <a  href="#">Announcements</a>
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
              <a  href="management.php">Management</a>
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
          <?php
          $sql2="SELECT * FROM announcements ";
          if (isset($_GET['announce'])){
            $sql2=$sql2."WHERE id=".$_GET['announce'];     
          } else{
            $sql2= $sql2 . "ORDER BY id DESC LIMIT 1";
          }
          $result2=$conn->query($sql2);
          if($result2->num_rows>0){
            $row2=$result2->fetch_assoc();
            echo'<h2 style="margin-left: 20px; color: saddlebrown;">'.$row2["topic"].'</h2>';
            echo'<div class="space"></div>';
            echo'<p style="padding-top: 10px;">';
            echo $row2['announcement'];
            echo'</p>';
            echo'<div class="space"></div>';
          }
          ?>
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