<?php 
    require_once 'db_config.php';
    if(!empty($_POST)){
        $email = $_POST['email'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $originalDate = $_POST['birthdate'];
        $birthDate = date("Y/m/d", strtotime($originalDate));
        $sql = "SELECT * FROM student where email = '".$email."'";
        $result = $mysqli->query($sql);
        if($result->num_rows === 0){
            $sqlIns = "INSERT INTO student (`studentID`, `studentName`, `email`, `birthDate`) VALUES ('2', '".$firstName." ".$lastName."', '".$email."','".$birthDate."')";
            $result = $mysqli->query($sqlIns);
        }else{
            $error = "Ya existe";
        }
        header("Location: todos.php");
    }else{
        header("Location: index.php");
    }
 ?>