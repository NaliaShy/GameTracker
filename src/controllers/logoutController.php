<?php
/*Archvo para cerrar seccion*/ 
session_start();
session_unset();   // limpia variables
session_destroy(); // destruye la sesión

// Redirige a la página principal o al login
header("Location: ../views/Home/Home.php");
exit();
?>