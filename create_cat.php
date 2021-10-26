<?php include 'header.php' ?>
<?php

$link = mysqli_connect('localhost', 'root', '', 'foro');

if (!$link) {
    exit('Error: No se pudo conectar con la base de datos (Puede ser el usuario, contraseña o servidor)');
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo '<form method="post" action="">
        Nombre de Categoría: <input type="text" name="cat_name" />
        Descripción de Categoría: <textarea name="cat_description" /></textarea>
        <input type="submit" value="Add category" />
     </form>';
} else {

    /*    $sql = "INSERT INTO
                categories(cat_name, cat_description)
       VALUES('" . mysqli_real_escape_string($link, $_POST['cat_name']) . "',
              '" . mysqli_real_escape_string($link, $_POST['cat_description']) . "',
              NOW(),
              0)";

    $result = mysqli_query($link, $sql);*/
    $name = $_POST['cat_name'];
    $description = $_POST['cat_description'];
    $sql = "INSERT INTO `categories`(`cat_name`, `cat_description`, `subj_id`) VALUES ('$name','$description', '$_GET[subj_id]')";
    $result = mysqli_query($link, $sql);

    if (!$result) {

        echo 'Error de MYSQL: ', mysqli_error($link);
    } else {
        echo 'Nueva categoría agregada con éxito.';
    }
}

?>