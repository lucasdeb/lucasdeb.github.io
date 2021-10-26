<?php

session_start();
/*if (isset($_SESSION['user_name']) && isset($_SESSION['user_pass'])){
    $user = $_SESSION['user_name'];
    $pass = $_SESSION['user_pass'];
}
else{
    header("Location: login.html");
    exit;
}*/

$link = mysqli_connect('localhost', 'root', '', 'foro');

if (!$link) {
    exit('Error: No se pudo conectar con la base de datos (Puede ser el usuario, contraseña o servidor)');
}

$sql= "SELECT subj_id, subj_name, subj_year, subj_semester FROM subjects";
$result = mysqli_query($link, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<title>primeraño</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <link rel="stylesheet" href="ccs-01.css">
</head>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        position: relative;
}

    td, th {
    border-bottom: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }
</style>

<body>
    <img src="https://i.ibb.co/rbtg8zz/ucalogo.png" alt="ucalogo" style="margin-left: 500px; margin-right: 500px;">
        <div style="color: white;"></div>
        <h1 class="foro" style="text-align: center;">Materias Primer Año</h1>
    <ul class="navbar">
    <li><a class="barra" href="/index.php">Home</a></li>
        <li><a class="barra" href="/primeraño.php">Materias Primer Año</a></li>
        <li><a class="barra" href="/Segundo-año.php">Materias Segundo Año</a></li>
        <li><a class="barra" href="/terceraño.php">Materias Tercer Año</a></li>
        <li><a class="barra" href="/cuartoaño.php">Materias Cuarto Año</a></li> 
        <li><a class="barra" href="/quintoaño.php">Materias Quinto Año</a></li>
    </ul>

    <header>
    <?php

            $link = mysqli_connect('localhost', 'root', '', 'foro');

            if (!$link) {
                exit('Error: No se pudo conectar con la base de datos (Puede ser el usuario, contraseña o servidor)');
            }


            function suscribir($userid, $subjid){
                $sql= "INSERT INTO `subscriptions` (`user_id`, `subj_id`) VALUES  ('$userid', '$subjid')";
                $link = mysqli_connect('localhost', 'root', '', 'foro');
                mysqli_query($link, $sql);
            }

            function desuscribir($userid, $subjid){
                $sql= "DELETE FROM `subscriptions` WHERE `subscriptions`.`subj_id` = '$subjid' AND `user_id` = '$userid'";
                $link = mysqli_connect('localhost', 'root', '', 'foro');
                mysqli_query($link, $sql);
            }
            
            if(isset($_GET['sus_subj_id'])){
                suscribir($_SESSION['user_id'], $_GET['sus_subj_id']);
            }

            if(isset($_GET['des_subj_id'])){
                desuscribir($_SESSION['user_id'], $_GET['des_subj_id']);
            }

            
            $sql = "SELECT `subj_id`, `subj_name`, `subj_year`, `subj_semester` FROM `subjects` WHERE `subj_year` IN ('1');";
            $userid = $_SESSION['user_id'];
            $sql2 = "SELECT `subj_id` FROM `subscriptions` WHERE `user_id` IN ('$userid');";
            $result = mysqli_query($link, $sql);
            $result2 = mysqli_query($link, $sql2);
            $array=array();
            $i=0;
            
            while(($row=mysqli_fetch_assoc($result2))){
                $array[$i]=$row['subj_id'];
                $i+=1;
            }
            
            //echo $array[1];
            echo '<table>
                    <tr>
                        <th>Materias</th>
                        <th>Semestre</th>
                    </tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                if(in_array($row['subj_id'], $array)) {                      
                        echo '<tr>
                        <td> <form method="post" action="?des_subj_id=' . $row["subj_id"] . ' ">
                        <input type="submit" class="barra" value="Desuscribirse"> </form> <br>'. $row['subj_name'] .'</td>
                        <td>'. $row['subj_semester'] .'</td>
                        </tr>
                        <tr>';
                }
                else{
                    echo '<tr>
                    <td> <form method="post" action="?sus_subj_id=' . $row["subj_id"] . ' ">
                    <input type="submit" class="barra" value="Suscribirse"> </form> <br>'. $row['subj_name'] .'</td>
                    <td>'. $row['subj_semester'] .'</td>
                    </tr>
                    <tr>';
                }   
            }



            ?>
    </header>

</body>
</html>