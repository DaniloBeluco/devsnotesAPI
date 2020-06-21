<?php
require('../config.php');

/* Pega o metodo da requisição que veio */
$method = strtolower($_SERVER['REQUEST_METHOD']);

$json = file_get_contents('php://input');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");
/* Se o metodo é POST */
if ($method === 'post') {

    $header = json_decode($json, true);

    /* Pega os campos que vieram no post */
    $title = $header['title'];
    $body = $header['body'];
    
    /* Se os campos tao preenchidos */
    if ($title && $body) {
        $sql = $pdo->prepare("INSERT INTO notes (title, body) VALUES (:title, :body)");
        $sql->bindValue(":title", $title);
        $sql->bindValue(":body", $body);
        $sql->execute();

        /* Pega o ultimo id inserido, usando PDO */
        $id = $pdo->lastInsertId();

        /* Array de retorno com o dado inserido */
        $array['result'] = [
            'id' => $id,
            'title' => $title,
            'body' => $body
        ];
    } else {
       $array['error'] = 'Precisa enviar title e body';
    }
} else {
    $array['error'] = 'Apenas é permitido o método POST';
}

require('../return.php');
