<?php
// Ruta: /backend/getProductos.php

// 1. Incluimos nuestro puente seguro
require 'conexion.php';

// 2. Preparamos la consulta para traer todo el catálogo
$consulta = $conexion->prepare("SELECT * FROM productos");

// 3. Ejecutamos la consulta
$consulta->execute();

// 4. Extraemos los resultados en un arreglo asociativo
$productos = $consulta->fetchAll(PDO::FETCH_ASSOC);

// 5. Le decimos al navegador que le vamos a enviar datos en formato JSON
header('Content-Type: application/json; charset=utf-8');

// 6. Convertimos el arreglo de PHP a JSON y lo imprimimos
echo json_encode($productos);
?>