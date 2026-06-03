<?php
// Ruta: /backend/conexion.php

// Credenciales de tu servidor FreeSQLDatabase en la nube
$host = "sql10.freesqldatabase.com";
$usuario = "sql10829222";
$password = "INPBmKPvZN"; 
$base_de_datos = "sql10829222";
$puerto = "3306";

try {
    // Usamos PDO (PHP Data Objects) incluyendo el puerto para la conexión en la nube
    $conexion = new PDO("mysql:host=$host;port=$puerto;dbname=$base_de_datos;charset=utf8", $usuario, $password);
    
    // Configuramos PDO para que nos alerte si hay errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    // Si algo falla, detenemos todo y mostramos el error
    die("Error crítico de conexión a la base de datos: " . $e->getMessage());
}
?>
