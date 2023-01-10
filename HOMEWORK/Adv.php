<?php
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


//$query ="UPDATE goods SET Price= $price WHERE id= $id";
$stmt=$dbcon->prepare("SELECT * FROM goods");
$stmt->execute();
$json= [];
$json2= [];
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $json[] = $Category;
    $json2[] = (int)$Adv;
}
if(isset($_POST['Change'])) {
    $dbhost = 'localhost';
    $dbname = 'nasserdb';
    $dbuser = 'root';
    $dbpass = '';

    $id = $_POST['id'];
    $price = $_POST['adv'];

    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $query = "UPDATE `goods` SET `Adv`='" . $price . "' WHERE `ID_Code`=$id";
    $result = mysqli_query($connect, $query);
    /*if($result)
    {
        echo "success";
    }
    else
    {
        echo "not success";
    }*/
    mysqli_close($connect);
    cahrt.update();
    header('Refresh:0');


}
?>




<html>
<head>
    <title>Adv-Report</title>
    <link rel="stylesheet" href="style2.css" />
    <style>

        body {
            background-image: url('Untitled1.png');
            background-size :100%;
            background-repeat: no-repeat;
        }
        }


    </style>
</head>

<body class="bg-warning py-20">

<div class="artboard">

    <div class="card">

        <div class="card__side card__side--back">
            <div class="card__cover">
                <h4 class="card__heading">
                    <span class="card__heading-span">Information</span>
                </h4>
            </div>
            <div class="card__details">
                <ul>
                    <canvas id="myChart"></canvas>
                    <form action="Adv.php" method="post">
                        <input type="text" name="id"required placeholder="ID_Code"><br></br>
                        <input type="text" name="adv"required placeholder="New_Adv"><br></br>
                        <button class="button" name="Change" required placeholder="Change" onclick="draw_line()">Update</button>
                        <button class="button" onclick="Main()">Back</button>
                    </form>

                    <button class="button" onclick="draw_line()">Line</button>
                    <button class="button" onclick="draw_bar()">Bar</button>
                    <button class="button" onclick="draw_pie()">Pie</button>


                </ul>
            </div>
        </div>

        <div class="card__side card__side--front">
            <div class="card__theme">
                <div class="card__theme-box">
                    <p class="card__subject">Adv-Report</p>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
</div>
<canvas id="myChart"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    var chart;
    var types = ['line', 'bar', 'pie'];
    var current_type = 0;
    draw_initial();

    function switch_type(){
        if(current_type++ == types.length-1) current_type = 0;
        switch(current_type){
            case 0: draw_line(); break;
            case 1: draw_bar(); break;
            case 2: draw_pie(); break;
        }
    }

    function draw_pie() {
        if(chart) chart.destroy();
        var ctx = document.getElementById('myChart').getContext('2d');
        chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($json); ?>,
                datasets: [{
                    label: "Adv",
                    backgroundColor: 'rgb(50, 120, 0, 0.65)',
                    borderColor: 'rgb(0, 0, 0)',
                    data:<?php echo json_encode($json2); ?>,
                }]
            },


            options: {}
        });
    }


    function draw_bar() {
        if(chart) chart.destroy();
        var ctx = document.getElementById('myChart').getContext('2d');
        chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($json); ?>,
                datasets: [{
                    label: "Adv",
                    backgroundColor: 'rgb(50, 120, 0, 0.65)',
                    borderColor: 'rgb(0, 0, 0)',
                    data:<?php echo json_encode($json2); ?>,
                }]
            },
            options: {}
        });
    }

    function draw_line() {
        if(chart) chart.destroy();


        var ctx = document.getElementById('myChart').getContext('2d');
        chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($json); ?>,
                datasets: [{
                    label: "Adv",
                    backgroundColor: 'rgb(50, 120, 0, 0.65)',
                    borderColor: 'rgb(0, 0, 0)',
                    data:<?php echo json_encode($json2); ?>,
                }]
            },


            options: {}
        });
    }

    function Main() {
        location.href="Main.php"
    }


    function draw_initial() {
        draw_line();
    }
</script>