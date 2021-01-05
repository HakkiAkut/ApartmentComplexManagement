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
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,400&display=swap"
      rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400&display=swap"
      rel="stylesheet">
    

  <title>Resident List</title>
    <script type='text/javascript'>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <script type='text/javascript'>
        $(document).on("click", ".delete", function(){
            var $rowtable = $(this).closest("tr");
            var uid = parseInt($rowtable.find("td:nth-child(1)").text());
            $(this).parents("tr").clone().appendTo($("#departed-table"));
            $(this).parents("tr").remove();
            let today = new Date().toISOString().slice(0, 10)
            document.getElementById("departed-table").rows[document.getElementById("departed-table").rows.length - 1].cells[4].innerHTML=today;
            jQuery.ajax({
                type: "POST",
                url: 'depart-resident.php',
                dataType: 'json',
                data: {id: uid},
                success: function (obj) {
                  if(obj.success=='1') {
                      //alert("done");
                  }
                  else {
                    window.location.reload();
                    alert("departion is not succesfull!");
                  }
            }
            });     
        });
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
        <a href="#" class="list-group-item list-group-item-action ">Resident List</a>
        <a href="dues-list.php" class="list-group-item list-group-item-action ">Due List</a>
        <a href="update-dues.php" class="list-group-item list-group-item-action ">Update Dues</a>
        <a href="expense-income.php" class="list-group-item list-group-item-action ">Expense/Income</a>
        <a href="messages.php" class="list-group-item list-group-item-action ">Messages</a>
        <a href="add-announcement.php" class="list-group-item list-group-item-action ">Add Announce</a>

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
          <h2 style="margin-left: 20px; color: saddlebrown;">Resident List</h2>
          <div class="space"></div>
          <button type="button" class="btn btn-info block-form list-btn" data-toggle="collapse" data-target="#apartmentA"><span class="list-btn">Apartment A</span></button>
                    <div id="apartmentA" class="collapse">
                         <?php
                        $conn = new mysqli("localhost", "root", "1234","web20");
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT id, name, surname, apartment, house_no, date_of_entry, date_of_departure FROM user WHERE state=1 AND apartment='A'";
                        $result = $conn-> query($sql);
                        if($result-> num_rows >0){
                            echo "<table class=\"table table-striped table-borderless\">";
                            echo "<tr> <th>UID</th>
                                <th>Name</th> 
                                <th>House</th> 
                                <th>Entry Date</th>
                                <th>Departure Date</th>
                                </tr>";
                            while($row = $result->fetch_assoc()){
                                echo "<tr><td>".$row['id']."</td><td>" . $row['name'] . " " .$row['surname'] . "</td><td>".
                                $row['apartment']."/".$row['house_no']."</td><td>".
                                $row['date_of_entry']."</td><td>".
                                $row['date_of_departure'] . "</td>
                                <td><a class=\"delete\" title=\"Delete\" data-toggle=\"tooltip\"><i class=\"material-icons\"></i></a></td>
                                </tr>";
                            }
                            echo"</table>";
                        } else {
                            echo "there is no record!";
                        }
                        ?>
                    </div>
                    <button type="button" class="btn btn-info block-form list-btn" data-toggle="collapse" data-target="#apartmentB"><span class="list-btn">Apartment B </span></button>
                    <div id="apartmentB" class="collapse">
                         <?php
                        $conn = new mysqli("localhost", "root", "1234","web20");
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT id, name, surname, apartment, house_no, date_of_entry, date_of_departure FROM user WHERE state=1 AND apartment='B'";
                        $result = $conn-> query($sql);
                        if($result-> num_rows >0){
                            echo "<table class=\"table table-striped table-borderless\">";
                            echo "<tr><th>UID</th>
                            <th>Name</th> 
                                <th>House</th> 
                                <th>Entry Date</th>
                                <th>Departure Date</th>
                                </tr>";
                            while($row = $result->fetch_assoc()){
                                echo "<tr><td>".$row['id']."</td><td>" . $row['name'] . " " .$row['surname'] . "</td><td>".
                                $row['apartment']."/".$row['house_no']."</td><td>".
                                $row['date_of_entry']."</td><td>".
                                $row['date_of_departure'] . "</td>
                                <td><a class=\"delete\" title=\"Delete\" data-toggle=\"tooltip\"><i class=\"material-icons\"></i></a></td></tr>";
                            }
                            echo"</table>";
                        } else {
                            echo "there is no record!";
                        }
                        ?>
                    </div>
                    <button type="button" class="btn btn-info block-form list-btn" data-toggle="collapse" data-target="#apartmentC"><span class="list-btn">Apartment C </span></button>
                    <div id="apartmentC" class="collapse">
                         <?php
                        $conn = new mysqli("localhost", "root", "1234","web20");
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT id, name, surname, apartment, house_no, date_of_entry, date_of_departure FROM user WHERE state=1 AND apartment='C'";
                        $result = $conn-> query($sql);
                        if($result-> num_rows >0){
                            echo "<table class=\"table table-striped table-borderless\">";
                            echo "<tr><th>UID</th>
                                <th>Name</th> 
                                <th>House</th> 
                                <th>Entry Date</th>
                                <th>Departure Date</th>
                                </tr>";
                            while($row = $result->fetch_assoc()){
                                echo "<tr><td>".$row['id']."</td><td>" . $row['name'] . " " .$row['surname'] . "</td><td>".
                                $row['apartment']."/".$row['house_no']."</td><td>".
                                $row['date_of_entry']."</td><td>".
                                $row['date_of_departure'] . "</td>
                                <td><a class=\"delete\" title=\"Delete\" data-toggle=\"tooltip\"><i class=\"material-icons\"></i></a></td></tr>";
                            }
                            echo"</table>";
                        } else {
                            echo "there is no record!";
                        }
                        ?>
                    </div>
                    <button type="button" class="btn btn-info block-form" data-toggle="collapse" data-target="#departed"><span class="list-btn">Departed Residents</span></span></button>
                    <div id="departed" class="collapse">
                         <?php
                        $conn = new mysqli("localhost", "root", "1234","web20");
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT id, name, surname, apartment, house_no, date_of_entry, date_of_departure FROM user WHERE state=0";
                        $result = $conn-> query($sql);
                        if($result-> num_rows >0){
                            echo "<table id=\"departed-table\" class=\"table table-striped table-borderless\">";
                            echo "<tr><th>UID</th>
                                <th>Name</th> 
                                <th>House</th> 
                                <th>Entry Date</th>
                                <th>Departure Date</th>
                                </tr>";
                            while($row = $result->fetch_assoc()){
                                echo "<tr><td>".$row['id']."</td><td>" . $row['name'] . " " .$row['surname'] . "</td><td>".
                                $row['apartment']."/".$row['house_no']."</td><td>".
                                $row['date_of_entry']."</td><td>".
                                $row['date_of_departure'] . "</td></tr>";
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
