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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <title>Admin Panel</title>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
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
                                <a href="../announcements.html" class="top-nav-link">Announcements</a>
                            </li>
                            <li class="top-nav-item">
                                <a href="../management.html" class="top-nav-link">Management</a>
                            </li>
                            <li class="top-nav-item">
                                <a href="../document.html" class="top-nav-link">Documents</a>
                            </li>
                            <li class="top-nav-item">
                                <div class="dropdown-button">
                                    <button class="dropdown-item">Contact
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-content">
                                        <a href="../contact.html">suggestion</a>
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
                            <a href="add-resident.php">
                                <p class="left-title" style="margin-top: 10px;margin-bottom:10px">
                                    Add Resident
                                </p>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="resident-list.php">
                                <p class="left-title" style="margin-top: 10px;margin-bottom:10px">
                                    Resident List
                                </p>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="#">
                                <p class="left-title" style="margin-top: 10px;margin-bottom:10px">
                                    add Document
                                </p>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="#">
                                <p class="left-title" style="margin-top: 10px;margin-bottom:10px">
                                    Due List
                                </p>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="update-dues.php">
                                <p class="left-title" style="margin-top: 10px;margin-bottom:10px;">
                                    Update Dues
                                </p>
                            </a>
                        </li>
                        <hr>
                    </ul>
                    <form action="logout.php" method="post">
                        <input type="submit" style="color:#7EA172;" id="logout" value="Log out" name="logout"></input>
                    </form>
                </div>
                <div class="main-panel" id="admin-panel">
                    <h2 style="margin-left: 20px; color: saddlebrown;">Due List</h2>
                    <div class="space"></div>
                    <form class="input-form"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label for="collected">collected</label>
                        <input type="checkbox" name="collected" id="collected">
                        <label for="month-list">month</label><span style="font-size: 11px;">*leave blank for all months</span>
                        <input type="month" name="month" id="month-list">
                        <label for="apartments">Apartment</label> 
                                <?php 
                                $apartments = array("choose one","A","B","C");
                                echo "<select name=\"apartments\">";
                                foreach($apartments as $value){
                                    echo "<option> $value </option>";
                                }
                                echo "<select>";
                                ?>
                                <label for="door_no">door no</label>
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
                    <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $conn = new mysqli("localhost", "root", "1234","web20");
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql="select dues.id,dues.uid,dues.charge,dues.date,dues.paid_date,
                        user.name,user.surname,user.apartment,user.house_no from dues inner join user on user.id=dues.uid where ";
                        if(isset($_POST["collected"])){
                            $sql = $sql . "paid_date is not null";
                        } else{
                            $sql = $sql . "paid_date IS NULL";
                        }
                        if($_POST["month"]!=""){
                            $mnth=$_POST["month"] . "-00";
                            $sql = $sql . " AND dues.date = '$mnth'";
                        }
                        if($_POST["apartments"]!="choose one"){
                            $apt=$_POST["apartments"];
                            $sql = $sql . " AND user.apartment='$apt'";
                            if($_POST["door_no"]!="choose one"){
                                $drno=$_POST["door_no"];
                                $sql = $sql . " AND user.house_no='$drno'";
                            }
                        }
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            
                            echo "<table class=\"basic-table\">";
                            echo "<tr> <th>ID</th>
                                <th>date</th>
                                <th>Charge</th>
                                <th>Name</th> 
                                <th>House</th>
                                <th>Paid Date</th></tr>";
                            while($row = $result->fetch_assoc()){
                                $date1 = $row['date'];     
                                $date= date('M-Y', strtotime($date1));
                                echo "<tr><td>".$row['id']."</td><td>". $date."</td><td>".$row['charge']."</td><td>" .$row['name']
                                ." ". $row['surname'] . "</td><td>".$row['apartment']."/".$row['house_no']."</td><td>".
                                $row['paid_date']."</td></tr>";
                            }
                            echo"</table>";
                        } else {
                            echo "there is no record!";
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
</body>
</html>