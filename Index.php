<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<title>TP1</title>
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
}

    td, th {
    border-bottom: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }
</style>
<body>
    <ul class="navbar">
        <li><a class="barra" href="/index.php">Home</a></li>
        <li><a class="barra" href="/login.html">Inicio</a></li>
        <li><a class="barra" href="/primeraño.php">Materias Primer Año</a></li>
        <li><a class="barra" href="/Segundo-año.php">Materias Segundo Año</a></li>
        <li><a class="barra" href="/terceraño.php">Materias Tercer Año</a></li>
        <li><a class="barra" href="/cuartoaño.php">Materias Cuarto Año</a></li>
        <li><a class="barra" href="/quintoaño.php">Materias Quinto Año</a></li>
    </ul>

    <header style="margin-left: 5%;">
        <img src="https://i.ibb.co/rbtg8zz/ucalogo.png" alt="ucalogo">
        <div style="color: white;"></div>
        <h1 class="foro">Foro de Consultas CEIUCA</h1>
        <p class="nombres">Lucas Debarbieri, Ignacio DiBartolo y Camilo Formica</p>
        <div style="position: left; border-style: solid; margin-left: 100px; margin-right: 100px; border-color: #333;">
        <h1><?php echo $_SESSION['user_name']; ?></h1>
            <h2>151903205</h2>
            <h2>Ingenieria Informatica</h2>
            <img src="foto-perfil.jpeg" width="300" height="300">
            <?php

            $link = mysqli_connect('localhost', 'root', '', 'foro');

            if (!$link) {
                exit('Error: No se pudo conectar con la base de datos (Puede ser el usuario, contraseña o servidor)');
            }

            $userid = $_SESSION['user_id'];
            
            $sql = "SELECT `subj_id`, `subj_name`, `subj_year`, `subj_semester` FROM `subjects`;";
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
                        <th>Año</th>
                    </tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                if(in_array($row['subj_id'], $array)) {                      
                        echo '<tr>
                        <td><a class="barra" href="foro/index.php?subj_id='. $row['subj_id'].'" style="margin-right: 10px;">Foro</a> '. $row['subj_name'] .' </td>
                        <td>'. $row['subj_year'] .'</td>
                        </tr>
                        <tr>';
                }
            }
            ?>
        </div>
</body>

</html>