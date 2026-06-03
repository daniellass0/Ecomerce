<?php
// Ruta: /backend/conexion.php

// Credenciales por defecto de XAMPP
$host = "localhost";
$usuario = "root";
$password = ""; // En XAMPP la contraseña de root suele estar vacía por defecto
$base_de_datos = "ecommerce_tech";

try {
    // Usamos PDO (PHP Data Objects) porque es la forma más moderna y segura de conectar en PHP
    $conexion = new PDO("mysql:host=$host;dbname=$base_de_datos;charset=utf8", $usuario, $password);
    
    // Configuramos PDO para que nos alerte si hay errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Puedes descomentar la siguiente línea temporalmente para probar que funcione:
    // echo "¡Conexión a la base de datos súper exitosa!";
    
} catch(PDOException $e) {
    // Si algo falla, detenemos todo y mostramos el error
    die("Error crítico de conexión a la base de datos: " . $e->getMessage());
}
?>