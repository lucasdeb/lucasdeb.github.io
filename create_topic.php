<?php

$link = mysqli_connect('localhost', 'root', '', 'foro');

if (!$link) {
    exit('Error: No se pudo conectar con la base de datos (Puede ser el usuario, contraseña o servidor)');
}

include 'header.php';

echo '<h2>Create a topic</h2>';
if ($_SESSION['signed_in'] == false) {

    echo 'Tenes que estar<a href="signin.php"> registrado</a> para crear un tema';
} else {

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {

        $sql = "SELECT cat_id, cat_name, cat_description FROM categories WHERE `subj_id` IN ('$_GET[subj_id]')";

        $result = mysqli_query($link, $sql);

        if (!$result) {

            echo 'Error seleccionando de la base de datos.';
        } else {
            if (mysqli_num_rows($result) == 0) {

                if ($_SESSION['user_level'] == 1) {
                    echo 'No creaste ninguna categoría';
                } else {
                    echo 'Antes de crear un tema, tenes que esperar que el Adminisitrado crea un tema.';
                }
            } else {

                echo '<form method="post" action="">
                    Tema: <input type="text" name="topic_subject" />
                    Categoría:';

                echo '<select name="topic_cat">';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                }
                echo '</select>';

                echo 'Mensaje: <textarea name="post_content" /></textarea>
                    <input type="submit" value="Create topic" />
                 </form>';
            }
        }
    } else {

        $query  = "BEGIN WORK;";
        $result = mysqli_query($link, $query);

        if (!$result) {

            echo 'Ocurrió un error al crear el tema.';
        } else {


            $sql = "INSERT INTO 
                        topics(topic_subject,
                               topic_date,
                               topic_cat,
                               topic_by)
                   VALUES('" . mysqli_real_escape_string($link, $_POST['topic_subject']) . "',
                               NOW(),
                               " . mysqli_real_escape_string($link, $_POST['topic_cat']) . ",
                               " . $_SESSION['user_id'] . "
                               )";

            $result = mysqli_query($link, $sql);
            if (!$result) {

                echo 'Ocurrió un error agregando datos' . mysqli_error($link);
                $sql = "ROLLBACK;";
                $result = mysqli_query($link, $sql);
            } else {

                $sql = "SELECT * FROM `topics` ORDER BY `topics`.`topic_id` DESC";
                $result = mysqli_query($link, $sql);
                $result = mysqli_fetch_array($result);
                $topicid = $result[0];


                $sql = "INSERT INTO
                            posts(post_content,
                                  post_date,
                                  post_topic,
                                  post_by)
                        VALUES
                            ('" . mysqli_real_escape_string($link, $_POST['post_content']) . "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $_SESSION['user_id'] . "
                            )";
                $result = mysqli_query($link, $sql);

                if (!$result) {

                    echo 'Ocurrió un error insertando el posteo' . mysqli_error($link);
                    $sql = "ROLLBACK;";
                    $result = mysqli_query($link, $sql);
                } else {
                    $sql = "COMMIT;";
                    $result = mysqli_query($link, $sql);


                    echo '<a href="topic.php?id=' . $topicid . '">tu tema fue creado con éxito</a>.';
                }
            }
        }
    }
}

include 'footer.php';
?>