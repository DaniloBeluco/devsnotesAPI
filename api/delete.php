<?php
require('../config.php');

/* Pega o metodo da requisição que veio */
$method = strtolower($_SERVER['REQUEST_METHOD']);

/* Se o metodo é PUT */
if ($method === 'delete') {

    /* Le o input raiz, transf em array e pega o put */
    parse_str(file_get_contents('php://input'), $input);

    $id = $input['id'] ?? null;

    $id = filter_var($id);

    if ($id) {

        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount > 0) {

            $sql = $pdo->prepare("DELETE * FROM notes WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

        } else {
            $array['error'] = "ID não existente";
        }
    } else {
        $array['error'] = "ID não enviado";
    }
} else {
    $array['error'] = 'Apenas é permitido o método DELETE';
}

require('../return.php');
