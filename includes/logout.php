<?php ob_start(); ?>
<?php session_start(); ?> <!-- turning on session -->

<?php

// cancelling session when logout

$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['user_role'] = null;

header("Location: ../index.php");

?>