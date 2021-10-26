

<?php
$link = mysqli_connect('localhost', 'root', '', 'foro');

if (!$link) {
    exit('Error: No se pudo conectar con la base de datos (Puede ser el usuario, contraseña o servidor)');
}

$subject = $_GET['subj_id'];
$sql = "SELECT cat_name FROM categories WHERE `cat_id` IN ('$subject')";
$result = mysqli_query($link, $sql);
$array = mysqli_fetch_array($result); 
$header = "CATEGORIA ". $array[0];

include 'header.php';


$sql = "SELECT cat_id, cat_name, cat_description FROM categories WHERE cat_id = '$_GET[subj_id]' ";
$result = mysqli_query($link, $sql);

if (!$result) {
    echo 'No se pudo mostrar la categoría, inténtelo de nuevo más tarde' . mysqli_error($link);
} else {
    if (mysqli_num_rows($result) == 0) {
        echo 'La categoría no existe';
    } else {

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<h2>Temas en la Categoría ' . $row['cat_name'] . '</h2>';
        }


        $sql = "SELECT  topic_id, topic_subject, topic_date, topic_cat FROM topics WHERE topic_cat='$_GET[subj_id]'";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo 'No se pudieron mostrar los temas. Vuelva a intentarlo más tarde.';
        } else {
            if (mysqli_num_rows($result) == 0) {
                echo 'Aún no hay temas en esta categoría.';
            } else {

                echo '<table border="1">
                      <tr>
                        <th>Tema</th>
                        <th>Creado el</th>
                      </tr>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td class="leftpart">';
                    echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
                    echo '</td>';
                    echo '<td class="rightpart">';
                    echo date('d-m-Y', strtotime($row['topic_date']));
                    echo '</td>';
                    echo '</tr>';
                }
            }
        }
    }
}

include 'footer.php';
?>