<?php
require('../config.php');

/* Pega o metodo da requisição que veio */
$method = strtolower($_SERVER['REQUEST_METHOD']);

/* Se o metodo é POST */
if ($method === 'post') {

    /* Pega os campos que vieram no post */
    $title = filter_input(INPUT_POST, 'title');
    $body = filter_input(INPUT_POST, 'body');

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
