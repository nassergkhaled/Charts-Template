<?php

$y=1;

$dbhost = 'localhost';
$dbname = 'nasserdb';
$dbuser = 'root';
$dbpass ='';



try{
    $dbcon = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
    $dbcon->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $ex) {
    die($ex->getMessage());
}
if(isset($_GET['submit'])){
    $y=$_GET['month'];
}

$stmt=$dbcon->prepare("SELECT * FROM goods WHERE month=$y");
$stmt->execute();
$json=[];
$json2=[];

while($row=$stmt->fetch(pdo::FETCH_ASSOC)) {
    extract($row);
    echo " ";
    $json[]= $Price;
    $json2[]= $month;
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <style>

        body {
            background-image: url('A.jpg');
            background-size :100%;
            background-repeat: no-repeat;
        }
        }


    </style>
</head>
<body>
<form action="Search.php" method="get" >
    <label for="i">Enter number of year to see the number of infected people in it </label>
    <input type="text" name="month" id="i" value="" minlength="1" maxlength="2" placeholder="start from 1 to 12">
    <input type="submit" name="submit" value="select">
    <button  name="Btn11" onclick="C()" ">Back</button>



</form>
<div style="height: 600px; width: 600px;position: absolute" >
    <canvas id="myChart" width="200" height="200"  style="display: block" ></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
    function C(){
        location.href="Main.php";

    }

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:  <?php echo json_encode($json2);?>,
            datasets: [{
                label: 'Total Profits',
                data: <?php echo json_encode($json);?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });



</script>
</body>
</html>