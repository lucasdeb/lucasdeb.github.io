<!DOCTYPE html>

<style>
.verde{
  background-color: rgba(0, 255, 0, 0.15)
}
.rojo{
  background-color: rgba(255, 0, 0, 0.15)
}
</style>

<?php
$link = mysqli_connect('localhost', 'root', '', 'foro');

if (!$link) {
    exit('Error: No se pudo conectar con la base de datos (Puede ser el usuario, contraseña o servidor)');
}

include 'header.php';

echo '<h3>Iniciar Sesión</h3>';


if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
    echo 'Ya ha iniciado sesión, puede <a href="signout.php"> cerrar sesión </a> si lo desea.';
} else {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {

        echo '<form method="post" action="">
            Usuario: <input type="text" name="user_name" id="user_name" class="rojo" />
            Contraseña: <input type="password" name="user_pass" id="user_pass" class="rojo">
            <button disabled="true" id="boton" type="submit">Ingresar</button>
         </form>';
    } else {

        $errors = array();

        if (!isset($_POST['user_name'])) {
            $errors[] = 'El campo de nombre de usuario no puede estar vacío.';
        }

        if (!isset($_POST['user_pass'])) {
            $errors[] = 'El campo de contraseña no puede estar vacío';
        }

        if (!empty($errors)) {
            echo 'Los campos no se ingresaron correctamente';
            echo '<ul>';
            foreach ($errors as $key => $value) {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>';
        } else {

            $sql = "SELECT 
                        user_id,
                        user_name,
                        user_level
                    FROM
                        users
                    WHERE
                        user_name = '" . mysqli_real_escape_string($link, $_POST['user_name']) . "'
                    AND
                        user_pass = '" . sha1($_POST['user_pass']) . "'";

            $result = mysqli_query($link, $sql);
            if (!$result) {

                echo 'Ocurrió un error';
            } else {

                if (mysqli_num_rows($result) == 0) {
                    echo 'Usuario o contraseña incorrecta';
                } else {

                    $_SESSION['signed_in'] = true;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $_SESSION['user_id']    = $row['user_id'];
                        $_SESSION['user_name']  = $row['user_name'];
                        $_SESSION['user_level'] = $row['user_level'];
                    }

                    echo 'Bienvenido, ' . $_SESSION['user_name'] . '. <a href="index.php">Ingresar al Foro</a>.';
                }
            }
        }
    }
}

include 'footer.php';
?>

<script type="text/javascript" src="../login.js">
</script>
