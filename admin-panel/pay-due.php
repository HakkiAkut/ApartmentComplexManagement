<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "1234","web20");
    if ($conn->connect_error) {                         
        die("Connection failed: " . $conn->connect_error);
    }
    $sql="SELECT id FROM dues WHERE uid=".$_POST['id'];
    $sql_income="INSERT INTO incomes(price, explanation, date) 
    SELECT  charge,'due income',DATE(NOW()) FROM dues WHERE id=";
    $query = $conn->query($sql);
    $sql1="UPDATE dues SET paid_date=DATE(NOW()) WHERE id=";
    while($row= $query->fetch_assoc()){
        $ids=$row['id'];
        if(isset($_POST[$ids])){
            $conn->query($sql1.$ids);
            $conn->query($sql_income.$ids);
        }
    }
    header("location: update-dues.php");
}
?>