<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "1234","web20");
    if ($conn->connect_error) {                         
        die("Connection failed: " . $conn->connect_error);
    }
    $sql="SELECT id FROM dues WHERE uid=".$_POST['id'];
    $sql_income_check= "SELECT * FROM incomes WHERE date= CAST(DATE_FORMAT(NOW() ,'%Y-%m-01') as DATE);";
    $query1=$conn->query($sql_income_check);
    $sql_income="UPDATE incomes SET price= price + (SELECT charge FROM dues WHERE id=";
    if(!$query1->num_rows>0){
        $sqls="INSERT INTO incomes(price, explanation, date) VALUES (0,'due income',CAST(DATE_FORMAT(NOW() ,'%Y-%m-01') as DATE))";
        $conn->query($sqls);
    }
    $query = $conn->query($sql);
    $sql1="UPDATE dues SET paid_date=DATE(NOW()) WHERE id=";
    
    while($row= $query->fetch_assoc()){
        $ids=$row['id'];
        if(isset($_POST[$ids])){
            $query2=$conn->query($sql1.$ids);
            $query1=$conn->query($sql_income.$ids.") WHERE date= CAST(DATE_FORMAT(NOW() ,'%Y-%m-01') as DATE) AND explanation='due income';");
            if($query1 === false || $query2===false){
                header("location: update-dues.php?error=2");
                $conn->close();
            }
        }
    }
    header("location: update-dues.php?success=1");
    $conn->close();
}
?>