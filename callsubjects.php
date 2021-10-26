<?php
$link = mysqli_connect('localhost', 'root', '', 'foro');

if (!$link) {
    exit('Error: No se pudo conectar con la base de datos (Puede ser el usuario, contraseña o servidor)');
}

session_start();

$sql= "SELECT subj_id, subj_name, subj_year, subj_semester FROM subjects";
$result = mysqli_query($link, $sql);

echo '<table border="2">
              <tr>
                <th>subject</th>
                <th>year</th>
              </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td class="leftpart">';
            echo "<h3><a href='foro/index.php?id=" . $row['subj_id'] . "'>" . $row['subj_name'] . '</a></h3>' . $row['subj_name'];
            echo '</td>';
        }
?>


