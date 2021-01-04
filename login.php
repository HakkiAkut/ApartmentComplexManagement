<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Apartment Complex Web Page">
    <meta name="keywords" content="Apartment Complex Web Page, Apartment Complex Manager">
    <meta name="description" content="a web site for the management of an apartment complex">
    <meta name="author" content="Hakkı Can Akut">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <title>Log in</title>
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light clear-div border-bottom top-nav-menu">
        <button style="background-color: rgb(143, 75, 58);border: saddlebrown;" class="btn btn-primary" id="menu-toggle"><i class="fa fa-caret-right"></i></button>
        <div id="logo-container">
          <a href="index.html" class="logo">
              Akdeniz Apartment Complex
          </a>
      </div>
      </nav>
  <?php
        $error_msg="";
        if(isset($_POST["Login"])){
          if($_POST['username']!="" and $_POST['password']!=""){
              $username=$_POST['username'];
              $pwd=$_POST['password'];
    
              $conn = new mysqli("localhost", "root", "1234","web20");
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
              $sql = "SELECT * FROM user WHERE username='$username' AND pwd='$pwd'";
              $query = $conn->query($sql);
              if($query === false){
                user_error("Query error $sql");
                return false;
              }
              if($query->num_rows>0){
                  $error_msg="";
                  session_start();
                  $row= $query->fetch_assoc();
                  
                  $_SESSION["userId"] = $row["id"];
                  $_SESSION["name"] = $row["name"];
                  $_SESSION["surname"] = $row["surname"];
                  $_SESSION["authority"] = $row["authority"];
                  
                  header("location: home-page.php");
              } else{
                  $error_msg="wrong username or password";
              }        
          }
          else{
            $error_msg="username and password can not be empty";
          }
        }
        if($error_msg!=""){ 
          echo $error_msg;
        }
        ?>
    <form class="login-box" action="" method="post">
        <h1>Login</h1>
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="Login" value="Login">
      </form>
      <hr>
      
</body>
</html>