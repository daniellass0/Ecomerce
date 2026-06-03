<?php

session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (
    !isset($data['usuario']) ||
    !isset($data['password'])
) {

    echo json_encode([
        "status" => "error",
        "message" => "Datos incompletos"
    ]);

    exit();
}

$usuarioCorrecto = "admin";
$passwordCorrecta = "123456";

if (
    $data['usuario'] === $usuarioCorrecto &&
    $data['password'] === $passwordCorrecta
) {

    $_SESSION['admin'] = $usuarioCorrecto;

    echo json_encode([
        "status" => "success"
    ]);

} else {

    echo json_encode([
        "status" => "error",
        "message" => "Credenciales incorrectas"
    ]);
}

?>