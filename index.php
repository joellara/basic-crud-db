<?php 
    require_once 'db_config.php';
    if(!empty($_POST)){
        $email = $_POST['email'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $originalDate = $_POST['birthdate'];
        $matricula = $_POST['matricula'];
        $birthDate = date("Y/m/d", strtotime($originalDate));
        $sql = "SELECT * FROM student where email = '".$email."'";
        $result = $mysqli->query($sql);
        if($result->num_rows === 0){
            $valid = true;
            $error = "";
            if (empty($firstName)) {
                $error .= "Please enter First Name<br>";
                $valid = false;
            }
            if (empty($lastName)) {
                $error .= "Please enter Last Name<br>";
                $valid = false;
            }
            if (empty($matricula)) {
                $error .= "Please enter a Student ID<br>";
                $valid = false;
            }
            if (empty($birthDate)) {
                $error .= "Please enter your Birthdate<br>";
                $error .= "$birthDate <br>";
                $valid = false;
            }
            if($valid){
                $sqlIns = "INSERT INTO student (`studentID`, `studentName`, `email`, `birthDate`) VALUES ('".$matricula."', '".$firstName." ".$lastName."', '".$email."','".$birthDate."')";
                $result = $mysqli->query($sqlIns);
                header("Location: todos.php?matricula=$matricula");
            }
        }else{
            $student = $result->fetch_assoc();
            $matricula = $student['studentID'];
            header("Location: todos.php?matricula=$matricula");
        }
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
            <h1>Database System Project by</h1>  
            <h3>Joel Lara,Esteban Gil, Daniel Sada</h3>
        </div>  
    </div>
    <div class="row">
        <div class="eleven columns">
            <h1>Dr. Vallejo</h1>
        </div>
    </div>
    <form method="post" action="index.php">
            <p style="color:red"> <?php if(!empty($error))echo $error; ?> </p>
            <div class="row">
                <div class="six columns">
                    <label for="firstName">Your first name</label>
                    <input class="u-full-width" name="firstName" type="text" value="<?php if(!empty($firstName))echo $firstName; ?>" placeholder="Pepe" id="firstName">  
                </div>
                <div class="six columns">
                    <label for="lastName">Your last name</label>
                    <input class="u-full-width" name="lastName" type="text" value="<?php if(!empty($lastName))echo $lastName; ?>" placeholder="El Toro" id="lastName">
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="matricula">Your student ID</label>
                    <input class="u-full-width" name="matricula" type="text" value="<?php if(!empty($matricula))echo $matricula; ?>" placeholder="A0137469" id="matricula">
                </div>
                <div class="six columns">
                    <label for="birthdate">Your birthdate</label>
                    <input class="u-full-width" type="date" name="birthdate" value="<?php if(!empty($birthdate))echo $birthdate; ?>" id="birthdate">
                </div>
            </div>
            <label for="email">Your email</label>
            <input class="u-full-width" type="email" name="email" placeholder="hola@email.com" id="email" value="<?php if(!empty($email))echo $email; ?>" required>
            <input class="button-primary" type="submit" value="Submit">
    </form>
  </div>
</body>
</html>
