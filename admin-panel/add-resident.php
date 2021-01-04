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
        <a href="#" class="list-group-item list-group-item-action ">Add Resident</a>
        <a href="resident-list.php" class="list-group-item list-group-item-action ">Resident List</a>
        <a href="dues-list.php" class="list-group-item list-group-item-action ">Due List</a>
        <a href="update-dues.php" class="list-group-item list-group-item-action ">Update Dues</a>

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
          <h2 style="margin-left: 20px; color: saddlebrown;">Add Resident</h2>
          <div class="space"></div>
          <?php
                        $nameError= $surnameError = $emailError = $usernameError=$pwdError=$dateError = $apartmentsError = $door_noError ="";
                        $name= $surname = $email = $username = $pwd=$date = $apartments= $door_no = "";
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (empty($_POST["name"])) {
                              $nameError = "Name is required";
                            } else {
                              $name = htmlspecialchars(stripslashes(trim($_POST["name"])));
                              if (!preg_match("/^([a-zA-Z' ]+)$/",$name)) {
                                $nameError = "Only letters are allowed";
                              }
                            }

                            if (empty($_POST["surname"])) {
                                $surnameError = "surname is required";
                              } else {
                                $surname = htmlspecialchars(stripslashes(trim($_POST["surname"])));
                                if (!preg_match("/^([a-zA-Z' ]+)$/",$surname)) {
                                  $surnameError = "Only letters are allowed";
                                }
                              }
                            
                            if (empty($_POST["email"])) {
                              $emailError = "Email is required";
                            } else {
                              $email = htmlspecialchars(stripslashes(trim($_POST["email"])));
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $emailError = "Invalid email address";
                                }
                            }
                              
                            if (empty($_POST["username"])) {
                              $usernameError = "username is required";
                            } else {
                              $username = htmlspecialchars(stripslashes(trim($_POST["username"])));
                                if(!preg_match('/^[a-zA-Z0-9]{6,}$/', $username)) { 
                                    $usernameError="Username must be alphanumeric and at least have 6 characters";
                                }
                            }
                            
                            if (empty($_POST["pwd"])) {
                                $pwdError = "password is required";
                              } else {
                                $pwd = htmlspecialchars(stripslashes(trim($_POST["pwd"])));
                                if(!preg_match('/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pwd)) { 
                                    $pwdError="Password must be at least 6 character, and need at least 1 number,
                                    1 uppercase character,
                                    1 lowercase character";
                                }
                              }
                              if(empty($_POST["date"])){
                                $dateError= "entry date is required";
                              }else {
                                  $date= $_POST["date"];
                              }
                          
                            if ($_POST["apartments"]=="choose one") {
                              $apartmentsError = "apartments is required";
                            } else {
                              $apartments = htmlspecialchars(stripslashes(trim($_POST["apartments"])));
                            }
                            if ($_POST["door_no"]=="choose one") {
                                $door_noError = "door no is required";
                              } else {
                                $door_no = htmlspecialchars(stripslashes(trim($_POST["door_no"])));
                              }
                            if($_POST["apartments"]!="choose one" && $_POST["door_no"]!="choose one"){
                                $conn = new mysqli("localhost", "root", "1234","web20");
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                  }
                                  $sql = "SELECT * FROM user WHERE apartment='$apartments' AND house_no='$door_no' AND state='1'";
                                  $query = $conn->query($sql);
                                  if($query->num_rows>0){
                                    $door_noError="there is already one resident for house $door_no/$apartments";
                                  } 
                            }
                            if($nameError==''&&$surnameError==''&&$emailError==''&&$pwdError==''&&$dateError=='' &&$usernameError==''&&$apartmentsError==''&&$door_noError=='' ){
                                $sql = "INSERT INTO user (name, surname, email, pwd, username, authority, apartment, house_no,state,date_of_entry)
                                VALUES ('$name', '$surname', '$email', '$pwd', '$username', '0', '$apartments', '$door_no', '1','$date')";
                                $conn = new mysqli("localhost", "root", "1234","web20");
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                  }
                                  if ($conn->query($sql) === TRUE) {
                                    echo "New resident created successfully!";
                                    $_POST['name']="";
                                    $_POST['surname']="";
                                    $_POST['email']="";
                                    $_POST['username']="";
                                    $_POST['pwd']="";
                                    $_POST['date']="";
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
                                <label for="name">Name</label> <span class="error">* <?php echo $nameError;?></span>
                                <input type="text"value="<?php echo (isset($_POST['name']))?$_POST['name']:'';?>" name="name" id="name">
                                <label for="surname">Surname</label> <span class="error">* <?php echo $surnameError;?></span>
                                <input type="text"value="<?php echo (isset($_POST['surname']))?$_POST['surname']:'';?>" name="surname">
                                <label for="email">Email</label> <span class="error">* <?php echo $emailError;?></span>
                                <input type="text"value="<?php echo (isset($_POST['email']))?$_POST['email']:'';?>" name="email">
                                <label for="username">Username</label> <span class="error">* <?php echo $usernameError;?></span>
                                <input type="text"value="<?php echo (isset($_POST['username']))?$_POST['username']:'';?>" name="username">
                                <label for="pwd">Password</label> <span class="error">* <?php echo $pwdError;?></span>
                                <input type="password"value="<?php echo (isset($_POST['pwd']))?$_POST['pwd']:'';?>" name="pwd">
                                <label for="date">Date of Entry</label> <span class="error">* <?php echo $dateError;?></span>
                                <div class="form-group">
                                    <div class='input-group date' id='datepicker1'>
                                    <input type="text" id="dp1" class="datepicker" name="date" readonly>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </input>
                                </div>

                                <label for="apartments">Apartment</label> <span class="error">* <?php echo $apartmentsError;?></span>  
                                <?php 
                                $apartments = array("choose one","A","B","C");
                                echo "<select name=\"apartments\">";
                                foreach($apartments as $value){
                                    echo "<option> $value </option>";
                                }
                                echo "<select>";
                                ?>
                                <label for="door_no">door no:</label> <span class="error">* <?php echo $door_noError;?></span>
                                <?php 
                                $door_no = array("choose one",1,2,3,4,5,6,7,8,9,10,11,12);
                                echo "<select name=\"door_no\">";
                                foreach($door_no as $value){
                                    echo "<option> $value </option>";
                                }
                                echo "<select>";
                                ?>
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