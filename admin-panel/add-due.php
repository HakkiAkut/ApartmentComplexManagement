<?php 
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["month"])) {
        $month= $_POST["month"] . "-01";
        $charge= $_POST["charge"];
        $conn = new mysqli("localhost", "root", "1234","web20");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sqlCheck="SELECT * FROM dues WHERE date='$month'";
        $query=$conn->query($sqlCheck);
        if($query->num_rows>0){
            header("location: update-dues.php?error=1");
            $conn->close();
        }
        $sql = "INSERT INTO dues (uid,date,charge)
            SELECT id,'$month',$charge
            FROM user
            WHERE state=1";
            if ($conn->query($sql) === TRUE) {
                header("location: update-dues.php?success=1");
                $conn->close();
              } else{
                header("location: update-dues.php?error=1");
                $conn->close();
              }
      }
}
?>



