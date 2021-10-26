<?php
session_start();
session_destroy();
header("Location: http://localhost/TP-1/foro/");
exit;
?>