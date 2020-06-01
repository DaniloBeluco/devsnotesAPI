<?php
require('../config.php');

/* Pega o metodo da requisição que veio */
$method = strtolower($_SERVER['REQUEST_METHOD']);

/* Se o metodo é GET */
if ($method === 'get') {

    $sql = $pdo->query("SELECT * FROM notes");
    $data = $sql->fetchAll(PDO::FETCH_ASSOC);

    /* Coloca os dados da array dentro de um campo de outra array */
    foreach ($data as $item) {

        $array['result'][] = [
            'id' => $item['id'],
            'title' => $item['title'],
        ];
        
    }
   
} else {
    $array['error'] = 'Apenas é permitido o método GET';
}

require('../return.php');
