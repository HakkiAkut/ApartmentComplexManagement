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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.js"></script>
    
  <title>Add Resident</title>
  <script type="text/javascript">
$(document).ready(function(){

$('.datepicker').datepicker({
format: 'yyyy-mm-dd',
autoclose: true,
startDate: '0d'
});

$('.cell').click(function(){
$('.cell').removeClass('select');
$(this).addClass('select');
});

});
    </script>
    <script>
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
      <div class="sidebar-heading">Home</div>
      <div class="list-group list-group-flush">
        <a href="add-resident.php" class="list-group-item list-group-item-action ">Add Resident</a>
        <a href="resident-list.php" class="list-group-item list-group-item-action ">Resident List</a>
        <a href="dues-list.php" class="list-group-item list-group-item-action ">Due List</a>
        <a href="update-dues.php" class="list-group-item list-group-item-action ">Update Dues</a>
        <a href="expense-income.php" class="list-group-item list-group-item-action ">Expense/Income</a>

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
              <a  href="../announcements.html">Announcments</a>
            </li>
            <li class="top-nav-item">
              <a  href="../document/dues.php">Documents</a>
            </li>
            <li class="top-nav-item">
                <?php
                    if($_SESSION["authority"]==1){
                      echo '<a href="admin-panel/add-resident.php" class="top-nav-link">Admin</a>';
                    }
                ?>
              </li>
            <li class="top-nav-item">
              <a  href="../management.html">Management</a>
            </li>
            <li class="top-nav-item dropdown-button">
              <a  href="#">
                Contact <i class="fa fa-caret-down"></i>
              </a>
              <div class="dropdown-menu-right dropdown-content" aria-labelledby="navbarDropdown">
                <a href="../contact.html">suggestion</a>
                <a href="#contact">contact info</a>
              </div>
            </li>
          </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <div class="main-panel">
          <h2 style="margin-left: 20px; color: saddlebrown;">Add Expense/Income</h2>
          <div class="space"></div>
          <?php
                        $dateError = $explanationError = $priceError ="";
                        $explanation= $price = $date= "";
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (empty($_POST["explanation"])) {
                              $nameError = "explanation is required";
                            } else {
                              $explanation = htmlspecialchars(stripslashes(trim($_POST["explanation"])));
                              if (!preg_match("/^([a-zA-Z' ]+)$/",$explanation)) {
                                $explanationError = "Only letters are allowed";
                              }
                            }
                            if (empty($_POST["price"])) {
                                $priceError = "price is required";
                              } else {
                                $price = htmlspecialchars(stripslashes(trim($_POST["price"])));
                              }
                              if(empty($_POST["date"])){
                                $dateError= "entry date is required";
                              }else {
                                  $date= $_POST["date"];
                              }
                            if($explanationError==''&&$priceError==''&&$dateError=='' ){
                                $sql= "INSERT INTO ";
                                if($_POST["table"]=="income"){
                                    $sql = $sql . " incomes ";
                                } else{
                                    $sql = $sql . " expenses ";
                                }
                                $sql = $sql ."(explanation, price, date)
                                VALUES ('$explanation', '$price','$date')";
                                $conn = new mysqli("localhost", "root", "1234","web20");
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                  }
                                  if ($conn->query($sql) === TRUE) {
                                    echo "New resident created successfully!";
                                    $_POST['explanation']="";
                                    $_POST['price']="";
                                  } else {
                                    echo "Error: " . $conn->error;
                                  }
                                  $conn->close();
                            }
                          }
                        ?>
                        <div class='col-sm-16'>
                        <div class="input-form">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <label for="explanation">Explanation</label> <span class="error">* <?php echo $explanationError;?></span>
                                <input type="text"value="<?php echo (isset($_POST['explanation']))?$_POST['explanation']:'';?>" name="explanation" id="explanation">
                                <label for="price">Price</label> <span class="error">* <?php echo $priceError;?></span>
                                <input type="text"value="<?php echo (isset($_POST['price']))?$_POST['price']:'';?>" name="price">
                                <label for="date">Date</label> <span class="error">* <?php echo $dateError;?></span>
                                <div class="form-group">
                                    <div class='input-group date' id='datepicker1'>
                                    <input type="text" id="dp1" class="datepicker" name="date" readonly>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </input>
                                </div>
                                <input type="radio" id="male" name="table" value="income">
                                <label for="male">Income</label><br>
                                <input type="radio" id="female" name="table" value="expense" checked="checked">
                                <label for="female">Expense</label><br>
                                <input type="submit" name="submit" value="Submit">  
                            </form>
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

  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
</body>
</html>