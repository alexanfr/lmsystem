<?php
session_start();
$_SESSION['lastname'] = null;
$_SESSION['firstname'] = null;
unset($_SESSION['lastname']);
unset($_SESSION['firstname']);
session_destroy();
echo '<script type="text/javascript">';
echo 'window.location.href="index.php" </script>';
?>
