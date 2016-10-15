<?php 
    include_once 'db_config.php';
    if(!empty($_GET['action']) && $_GET['action']=="del"){
      $sql_query="DELETE FROM studentnormaltask WHERE normalTaskID=".$_GET['delete_id'];
      $mysqli->query($sql_query);
      $sql_query="DELETE FROM normaltask WHERE normalTaskID=".$_GET['delete_id'];
      $mysqli->query($sql_query);
      header("Location: todos.php?matricula=".$_GET['matricula']);
    }elseif (!empty($_POST['action']) && $_POST['action']=="create") {
      $sql_query="INSERT INTO normaltask (`taskDescripcion`) VALUES ('".$_POST['taskDescription']."')";
      if(!$rst = $mysqli->query($sql_query)){
        $error = "No se pudo insertar";
        echo $error;
        exit;
      }else{
        $sql_query="INSERT INTO studentnormaltask (`studentID`,`normalTaskID`,`assignDate`) VALUES (".$_POST['matricula'].",'".$mysqli->insert_id."','".date("Y/m/d")."')";      
        if(!$rst =$mysqli->query($sql_query)){
          $error = "No se pudo insertar";
          echo $sql_query;
          exit;
        }
      }
      header("Location: todos.php?matricula=".$_POST['matricula']);
    }else{
      if(empty($_GET['matricula'])){
        header("Location: index.php");
      }else{
        $matricula = ltrim($_GET['matricula'], 0);
        $sqlUsuario = "SELECT * FROM student where studentID=".$matricula;
        $rst = $mysqli->query($sqlUsuario);
        $usuario = $rst->fetch_assoc();
        $nombre = $usuario['studentName'];
        $sql = "SELECT * FROM studentnormaltask,normaltask where studentID=".$matricula." AND studentnormaltask.normalTaskID=normaltask.normalTaskID";
        $resultados = true;
        if(!$result = $mysqli->query($sql)){
          echo "Sorry, the website is experiencing problems.";
          exit;
        }
        if ($result->num_rows === 0) {
          $resultados = false;
        }
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
  <script type="text/javascript">
  function delete_id(id,matricula)
  {
  console.log(id,matricula);
   if(confirm('Sure to Delete ?'))
   {
    window.location.href='todos.php?action=del&delete_id='+id+'&matricula='+matricula;
   }
  }
  </script>
</head>
<body>
  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">
        <div class="eleven columns" style="margin-top: 5%">
            <h1>Todo's of <?php echo $nombre ?></h1>  
        </div>  
    </div>
    <p class="error"> <?php if(!empty($error))echo $error; ?> </p>
    <form method="post" action="todos.php">
      <input type="hidden" name="action" value="create">
      <input type="hidden" name="matricula" value="<?php echo $matricula ?>">
      <div class="row">
        <div class="six columns">
          <label>Your task's description</label>
          <input type="text" name="taskDescription" required>
        </div>
      </div>
        <input type="submit" value="Add">
    </form>

    <div class="row">
      <table class="u-full-width">
        <thead>
          <tr>
            <th>Completed</th>
            <th>Todo</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!$resultados){
              echo "<p>No hay ningun todo, agrega uno nuevo.</p>";
            }else{
              while ($todo = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$todo['completed']."</td>";
                echo "<td>".$todo['taskDescripcion']."</td>";
                ?>
                <td><a href='javascript:delete_id(<?php echo $todo['normalTaskID']; ?>,<?php echo $matricula ?>)'>Delete</td></a>
                <?php
                echo "</tr>";
              }
            }
           ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
