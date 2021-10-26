<?php

$link = mysqli_connect('localhost', 'root', '', 'foro');

if (!$link) {
    exit('Error: No se pudo conectar con la base de datos (Puede ser el usuario, contraseña o servidor)');
}

include 'header.php';

echo '<h3>Registro</h3>';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo '<form method="post" action="">
        Usuario: <input type="text" name="user_name" />
        Password: <input type="password" name="user_pass">
        Password devuelta: <input type="password" name="user_pass_check">
        E-mail: <input type="email" name="user_email">
        <input type="submit" value="Crear Cuenta" />
     </form>';
} else {

    $errors = array();

    if (isset($_POST['user_name'])) {

        if (!ctype_alnum($_POST['user_name'])) {
            $errors[] = 'El campo de usuario solamente puede contener letras o numeros';
        }
        if (strlen($_POST['user_name']) > 30) {
            $errors[] = 'El usuario no puede contener mas de 30 caracteres';
        }
    } else {
        $errors[] = 'El campo de usuario no puede ser vacio';
    }


    if (isset($_POST['user_pass'])) {
        if ($_POST['user_pass'] != $_POST['user_pass_check']) {
            $errors[] = 'Las dos contraseñas no coinciden';
        }
    } else {
        $errors[] = 'El campo de la contraseña no puede estar vacía';
    }

    if (!empty($errors)) {
        echo 'Algo salío mal';
        echo '<ul>';
        foreach ($errors as $key => $value) {
            echo '<li>' . $value . '</li>';
        }
        echo '</ul>';
    } else {

        $user = $_POST['user_name'];
        $pass = sha1($_POST['user_pass']);
        $email = $_POST['user_email'];
        $sql = "INSERT INTO `users`(`user_name`, `user_pass`, `user_email`) VALUES ('$user','$pass','$email')";
        $result = mysqli_query($link, $sql);

        /*$sql = "INSERT INTO
                    users(user_name, user_pass, user_email ,user_date, user_level)
                VALUES('" . mysqli_real_escape_string($link, $_POST['user_name']) . "',
                       '" . sha1($_POST['user_pass']) . "',
                       '" . mysqli_real_escape_string($link, $_POST['user_email']) . "',
                        NOW(),
                        0)";
                         
        $result = mysqli_query($link, $sql);*/

        if (!$result) {
            echo 'Ocurrió un error';
            echo mysqli_error($link);
        } else {
            echo 'Registrado exitosamente <a href="signin.php">Iniciar Sesión</a>';
        }
    }
}

include 'footer.php';
?>