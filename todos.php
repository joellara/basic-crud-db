<?php 
    include_once 'db_config.php';
    $matricula = $_GET['matricula'];

    $sql = "SELECT * FROM student where studentID = '".$matricula."'";
    $result = $mysqli->query($sql);
    while ($todo = $result->fetch_assoc()) {
      $studentName = $todo['studentName'];
      $email = $todo['email'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Basic CRUD for Advanced Database Systems</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">
        <div class="eleven columns" style="margin-top: 5%">
            <h1>Todo's</h1>  
            <h3>Joel Lara,Esteban Gil, Daniel Sada</h3>
        </div>  
    </div>
    <?php if(!empty($studentName))echo $studentName; ?>
    <br>
    <?php if(!empty($email))echo $email; ?>
    <br>
    <?php if(!empty($matricula))echo $matricula; ?>
    <br><br><br>
    <?php 
      include_once 'db_config.php';
      $sql = "SELECT * FROM studentNormalTask where studentID = '".$matricula."'";
      $result = $mysqli->query($sql);
      echo $sql;
      while ($todo = $result->fetch_assoc()) {
        echo $normalTaskID = $todo['normalTaskID']."  ";
        echo $taskDescription = $todo['taskDescription']."<br>";
        echo "lol";
      }
  ?>
  </div>
</body>
</html>
