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
  <link rel="stylesheet" href="../styles.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,400&display=swap"
      rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400&display=swap"
      rel="stylesheet">
  <title>Docs</title>
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<?php
    if(!isset($_SESSION["name"])){
        header("location: index.html");
    }
    ?>

  <div class="d-flex page-container" id="wrapper">
    <div class="border-right left-panel" id="sidebar-wrapper">
      <div class="sidebar-heading">Docs</div>
      <div class="list-group list-group-flush">
        <a href="dues.php" class="list-group-item list-group-item-action ">Dues</a>
        <a href="#" class="list-group-item list-group-item-action ">Expense/Income</a>
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
              <a  href="#">Documents</a>
            </li>
            <li class="top-nav-item">
                <?php
                    if($_SESSION["authority"]==1){
                      echo '<a href="../admin-panel/add-resident.php" class="top-nav-link">Admin</a>';
                    }
                ?>
              </li>
            <li class="top-nav-item">
              <a  href="../management.php">Management</a>
            </li>
            <li class="top-nav-item dropdown-button">
              <a  href="../contact/send-messages.php"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Contact <i class="fa fa-caret-down"></i>
              </a>
              <div class="dropdown-menu-right dropdown-content" aria-labelledby="navbarDropdown">
                <a href="../contact/send-messages.php">suggestion</a>
                <a href="#contact">contact info</a>
              </div>
            </li>
          </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <div class="main-panel">
          <h2 style="margin-left: 20px; color: saddlebrown;">Expanses and Incomes</h2>
          <div class="space"></div>
          <button type="button" class="btn btn-info block-form list-btn" data-toggle="collapse" data-target="#expenses"><span class="list-btn">Expenses</span></button>
                    <div id="expenses" class="collapse">
                         <?php
                         $uid=$_SESSION['userId'];
                        $conn = new mysqli("localhost", "root", "1234","web20");
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT date, explanation,price FROM expenses WHERE date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()";
                        $result = $conn-> query($sql);
                        if($result-> num_rows >0){
                            echo "<table class=\"table table-striped table-borderless\">";
                            echo "<tr> <th>Date</th>
                                <th>Explanation</th> 
                                <th>Price</th> 
                                </tr>";
                            while($row = $result->fetch_assoc()){
                                echo "<tr><td>".$row['date']."</td><td>" .
                                $row['explanation'] . "</td><td>".
                                $row['price']."</td>
                                </tr>";
                            }
                            echo"</table>";
                        } else {
                            echo "there is no record!";
                        }
                        ?>
                    </div>
                    <button type="button" class="btn btn-info block-form list-btn" data-toggle="collapse" data-target="#incomes"><span class="list-btn">Incomes</span></button>
                    <div id="incomes" class="collapse">
                         <?php
                         $uid=$_SESSION['userId'];
                        $conn = new mysqli("localhost", "root", "1234","web20");
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT date, explanation,price FROM incomes WHERE date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()";
                        $result = $conn-> query($sql);
                        if($result-> num_rows >0){
                            echo "<table class=\"table table-striped table-borderless\">";
                            echo "<tr> <th>Date</th>
                            <th>Explanation</th> 
                            <th>Price</th> 
                                </tr>";
                            while($row = $result->fetch_assoc()){
                                echo "<tr><td>".$row['date']."</td><td>" .
                                $row['explanation'] . "</td><td>".
                                $row['price']."</td>
                                </tr>";
                            }
                            echo"</table>";
                        } else {
                            echo "there is no record!";
                        }
                        ?>
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