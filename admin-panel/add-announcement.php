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
  <link rel="stylesheet" href="../styles.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,400&display=swap"
      rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400&display=swap"
      rel="stylesheet">
  <title>Add Announcements</title>
    <script type='text/javascript'>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<?php
    if(!isset($_SESSION["authority"])){
        header("location: index.html");
    } else{
        if($_SESSION["authority"]==0){
            header("location: home-page.php");
        }
    }
?>
  <div class="d-flex page-container" id="wrapper">
    <div class="border-right left-panel" id="sidebar-wrapper">
      <div class="sidebar-heading">Admin</div>
      <div class="list-group list-group-flush">
        <a href="add-resident.php" class="list-group-item list-group-item-action ">Add Resident</a>
        <a href="resident-list.php" class="list-group-item list-group-item-action ">Resident List</a>
        <a href="dues-list.php" class="list-group-item list-group-item-action ">Due List</a>
        <a href="update-dues.php" class="list-group-item list-group-item-action ">Update Dues</a>
        <a href="expense-income.php" class="list-group-item list-group-item-action ">Expense/Income</a>
        <a href="messages.php" class="list-group-item list-group-item-action ">Messages</a>
        <a href="#" class="list-group-item list-group-item-action ">Add Announce</a>

        <form action="logout.php" method="post">
            <input type="submit" style="color:#7EA172;" id="logout" value="Log out" name="logout"></input>
        </form>
      </div>
    </div>
    <div id="page-content-wrapper" class="content-wrap">

      <nav class="navbar navbar-expand-lg navbar-light clear-div border-bottom top-nav-menu">
        <button style="background-color: rgb(143, 75, 58);border: saddlebrown;" class="btn btn-primary" id="menu-toggle"><i class="fa fa-caret-right"></i></button>
        <div id="logo-container">
          <a href="../home-page.php" class="logo">
              Akdeniz Apartment Complex
          </a>
      </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="top-nav-item">
              <a  href="../announcements.php">Announcements</a>
            </li>
            <li class="top-nav-item">
              <a  href="../document/dues.php">Documents</a>
            </li>
            <li class="top-nav-item">
                <?php
                    if($_SESSION["authority"]==1){
                      echo '<a href="add-resident.php" class="top-nav-link">Admin</a>';
                    }
                ?>
              </li>
            <li class="top-nav-item">
              <a  href="../management.php">Management</a>
            </li>
            <li class="top-nav-item dropdown-button">
              <a  href="#">
                Contact <i class="fa fa-caret-down"></i>
              </a>
              <div class="dropdown-menu-right dropdown-content" aria-labelledby="navbarDropdown">
                <a href="../contact.php">suggestion</a>
                <a href="#contact">contact info</a>
              </div>
            </li>
          </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <div class="main-panel">
          <h2 style="margin-left: 20px; color: saddlebrown;">Add Announcements</h2>
          <div class="space"></div>
          <form class="input-form" method="post">
            <label for="topic">Topic</label> <br>
            <input type="text" id="topic" name="topic">
            <br>
            <label for="announcement">Announcement</label> <br>
            <textarea name="announcement"></textarea>
            <br>
            <input type="submit" value="Submit">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
          if(empty($_POST["topic"])||empty($_POST["announcement"])){
            echo "topic and message con not be blank";
          } else{
            $topic=htmlspecialchars(stripslashes(trim($_POST["topic"])));
            $announcement=htmlspecialchars(stripslashes(trim($_POST["announcement"])));
            $conn = new mysqli("localhost", "root", "1234","web20");
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql="INSERT INTO announcements (topic, announcement,date)
            VALUES('$topic','$announcement',DATE(NOW()));";
            $result=$conn->query($sql);
            if($result===TRUE){
              echo "Your announcement is sended";
            }
          }
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
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
</body>
</html>
