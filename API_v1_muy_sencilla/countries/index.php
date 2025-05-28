<?php


// Devolver los datos de un país concreto
// localhost:8000/countries/index.php?country=Spain
// localhost:8000/countries/index.php?country=Italy

// Esto es un error: faltan datos
// localhost:8000/countries/index.php?country

// Esto es otro error: país no encontrado
// localhost:8000/countries/index.php?country=Itali

// Esto es un error
// localhost:8000/countries/index.php?country

// Devolver todos los paises
// localhost:8000/countries/index.php

// Con esta cabecera le decimos al navegador que la respuesta es JSON
header('Content-Type: application/json; charset=utf-8');

// Incluimos el archivo de conexión a la base de datos
require_once '../connection.php';


if (!$_GET) {
    $select = "SELECT * FROM country";
    $prep = $pdo->prepare($select);
    $prep->execute();
    $countries = $prep->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($countries, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit();
}

if (!$_GET['country'] || empty($_GET['country'])) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Parámetro incorrecto. Debe ser "country" con el nombre de un país']);
    exit();
} 


$country = $_GET['country'];

$select = "SELECT * FROM country WHERE name = :country";
$prep = $pdo->prepare($select);
$prep->bindParam(':country', $country, PDO::PARAM_STR);
$prep->execute();
$country = $prep->fetchAll(PDO::FETCH_ASSOC);

if (!$country) {
    http_response_code(404); // Not Found
    echo json_encode(['error' => 'País no encontrado. Revise el nombre del país']);
    exit();
}

echo json_encode($country, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);