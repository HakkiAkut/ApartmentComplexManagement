<?php
    header('Content-Type: application/json');
    $uid=$_POST['id'];
    $conn = new mysqli("localhost", "root", "1234","web20");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $today=date("Y-m-d");
            $sql = "UPDATE user SET state = 0, date_of_departure=DATE(NOW()) WHERE id=$uid";
            $result = $conn-> query($sql);
            if(mysqli_affected_rows($conn) >0){
                echo json_encode(array('success' => 1));
            } else{
                echo json_encode(array('success' => 0));
            }
?>