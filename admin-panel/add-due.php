<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["month"])) {
        $month= $_POST["month"] . "-01";
        $charge= $_POST["charge"];
        echo "bu yazı doğru demek $month";
        $conn = new mysqli("localhost", "root", "1234","web20");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO dues (uid,date,charge)
            SELECT id,'$month',$charge
            FROM user
            WHERE state=1";
            if ($conn->query($sql) === TRUE) {
                header("location: update-dues.php");
              }
      }
}
?>
</body>
</html>


