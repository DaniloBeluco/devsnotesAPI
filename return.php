<?php
/* Diz que qualquer domínio pode fazer requisição nessa API */
header("Access-Control-Allow-Origin: *");

/* Diz o tipo de requisições permitidos */
header("Acess-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

/* Diz que o retorno vai ser um json */
header("Content-Type: application/json");

echo json_encode($array);
exit;
