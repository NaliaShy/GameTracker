<?php
$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';

if ($email === 'admin' && $pass === '123') {
    header("Location: ../View/home/Home.php");
    exit;
}

echo "Credenciales incorrectas";
?>