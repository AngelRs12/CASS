<?php
session_start();
session_unset();
session_destroy();
header("Location: /cass/index.php");
exit();
?>
