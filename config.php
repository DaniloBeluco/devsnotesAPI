<?php
global $pdo;

try {
    $pdo = new PDO("mysql:dbname=devsnotes;host=localhost", "root", "");
} catch (PDOException $e) {
    //except
}

//se holve algum erro joga no error, se holve resultado joga no result
$array = [
    'error' => '',
    'result' => [],
];