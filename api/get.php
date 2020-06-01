<?php
require('../config.php');

/* Pega o metodo da requisição que veio */
$method = strtolower($_SERVER['REQUEST_METHOD']);

/* Se o metodo é GET */
if ($method === 'get') {

    /* Pega o id que veio no get */
    $id = filter_input(INPUT_GET, 'id');

    /* Se o id existe */
    if ($id) {
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $array['result'] = [
                'id' => $data['id'],
                'title' => $data['title'],
                'body' => $data['body'],
            ];

        } else {
            $array['error'] = 'ID não existente.';
        }
    } else {
        $array['error'] = 'ID não enviado.';
    }
} else {
    $array['error'] = 'Apenas é permitido o método GET';
}

require('../return.php');
