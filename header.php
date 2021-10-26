<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title class="titulos">Foro</title>

    <link rel="stylesheet" href="forostyle.css" type="text/css">
    <link rel="stylesheet" href="../ccs-01.css" type="text/css">

</head>


<body>
    <ul class="navbar">
        <li><a class="barra" href="index.php">Home</a></li>
        <li> <?php echo '<a class="barra" href="index.php?subj_id=' . $_GET['subj_id'] . '">Foro</a>' ?></li>
        <li> <?php echo '<a class="barra" href="create_topic.php?subj_id=' . $_GET['subj_id'] . '">Crea una discucion</a>' ?> </li>
        <li> <?php echo '<a class="barra" href="create_cat.php?subj_id=' . $_GET['subj_id'] . '">Crea una categoria</a>' ?> </li>
        <?php
        if (isset($_SESSION['signed_in'])) {
            echo '<a class="barra" href="signout.php">Cerrar sesión</a>';
        } else {
            echo '<a class="barra" href="signin.php">Iniciar Sesión</a><a class="barra" href="signup.php">Crear una Cuenta</a>';
        }
        ?>
    </ul>
    <h1 id="titulo"><?php echo $header ?></h1>


    <div id="wrapper">
        <div id="content">