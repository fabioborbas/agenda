<?php

$servername = "database";
$username = "root";
$password = "root";

$link = mysql_connect($servername, $username, $password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
date_default_timezone_set('America/Sao_Paulo');


function formatarTelefone($numeroTelefone)
{
    $numeroTelefone = preg_replace("/[^0-9]/", "", $numeroTelefone);
    if (strlen($numeroTelefone) == 11) {
        $numeroFormatado = sprintf(
            "(%s) %s-%s",
            substr($numeroTelefone, 0, 2),
            substr($numeroTelefone, 2, 5),
            substr($numeroTelefone, 7)
        );

        return $numeroFormatado;
    }
    return $numeroTelefone;
}

function mover_foto($vetor_foto)
{
    $vtipo = explode("/", $vetor_foto['type']);
    $tipo = $vtipo[0];
    $extensao = $tipo[1];
    if (!$vetor_foto['error'] && $tipo == "image") {
        $nome_arquivo  = date('Ymdhms') . $extensao;
        move_uploaded_file($vetor_foto['tmp_name'], "../img/" . $nome_arquivo);
        return $nome_arquivo;
    } else {
        return 0;
    }
}

mysql_select_db('test', $link);
