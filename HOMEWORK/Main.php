<?php
?>
<link rel="stylesheet" href="style4.css" />
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <title>Reports</title>
    <style>

body {
    background-image: url('Untitled.png');
    background-size :100%;
    background-repeat: no-repeat;
}
}


    </style>

</head>
<body>
<div>
    <div>
        <button class="button1" onclick="qa()">Search</button>
    </div>
    <div>
    <button class="button3" onclick="pr()">Price Reports</button>
</div>
    <div>
    <button class="button2" onclick="ad()">Adv Reports</button>
</div>
    <div>
    <button class="button" onclick="qu()">Quantity Reports</button>
    </div>


    <title>Reports</title>

</div>

</body>
</html>
<script>


    function pr() {
        location.href="price.php"
    }
    function qu() {
        location.href="Quantity.php"
    }
    function ad() {
        location.href="Adv.php"
    }
    function qa() {
        location.href="Search.php"
    }
</script>