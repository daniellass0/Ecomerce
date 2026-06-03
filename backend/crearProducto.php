<?php
// Ruta: /backend/crearProducto.php

// 1. Incluimos la conexión que ya teníamos creada
require 'conexion.php';

// 2. Leemos los datos que envía JavaScript en formato JSON
$datos = json_decode(file_get_contents("php://input"), true);

if ($datos) {
    try {
        // 3. Preparamos la consulta SQL segura para insertar
        $consulta = $conexion->prepare("INSERT INTO productos (nombre, descripcion, precio, categoria, imagen) VALUES (:nombre, :descripcion, :precio, :categoria, 'default.jpg')");
        
        // 4. Vinculamos los datos
        $consulta->bindParam(':nombre', $datos['nombre']);
        $consulta->bindParam(':descripcion', $datos['descripcion']);
        $consulta->bindParam(':precio', $datos['precio']);
        $consulta->bindParam(':categoria', $datos['categoria']);
        
        // 5. Ejecutamos
        $consulta->execute();
        
        // 6. Respondemos con éxito
        echo json_encode(["status" => "success", "mensaje" => "Producto guardado correctamente en la base de datos."]);
    } catch(PDOException $e) {
        echo json_encode(["status" => "error", "mensaje" => "Error al guardar: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "mensaje" => "No se recibieron datos."]);
}
?>