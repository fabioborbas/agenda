<?php

$servername = "database";
$username = "root";
$password = "root";

$link = mysql_connect($servername, $username, $password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
//echo 'Connected successfully';

function mensagem($texto, $tipo)
{

    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Mensagem Centralizada</title>
        <style>
            body {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 20vh;
                margin: 0;
                background-color: #f8f9fa; /* Cor de fundo da página, ajuste conforme necessário */
            }

            .alert-container {
                text-align: center;
            }

            .alert {
                display: inline-block;
                margin-bottom: 20px;
            }

            .btn-back {
                padding: 10px 20px;
                background-color: #007bff; /* Cor de fundo do botão, ajuste conforme necessário */
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <div class='alert-container'>
            <div class='alert alert-primary' role='alert'>$texto</div>
            <a href='index.php' class='btn-back'>Voltar</a>
        </div>
    </body>
    </html>
    ";
}

function formatarTelefone($numeroTelefone)
{
    // Remova todos os caracteres não numéricos do número
    $numeroTelefone = preg_replace("/[^0-9]/", "", $numeroTelefone);

    // Verifique se o número de telefone tem 11 dígitos (incluindo o código de área)
    if (strlen($numeroTelefone) == 11) {
        // Formate o número de telefone (XX) XXXX-XXXX
        $numeroFormatado = sprintf(
            "(%s) %s-%s",
            substr($numeroTelefone, 0, 2),
            substr($numeroTelefone, 2, 5),
            substr($numeroTelefone, 7)
        );

        return $numeroFormatado;
    }

    // Se o número de telefone não tiver 11 dígitos, retorne o número original
    return $numeroTelefone;
}

function mover_foto($vetor_foto)
{
    $vtipo = explode("/", $vetor_foto['type']);
    $tipo = $vtipo[0] ;
    $extensao = $tipo[1] ;
    if (!$vetor_foto['erro'] && $tipo = "image") {
        $nome_arquivo  = date('Ymdhms') . $extensao;
        move_uploaded_file($vetor_foto['tmp_name'], "img/" . $nome_arquivo);
        return $nome_arquivo;
    } else {
        return 0;
    }
}

mysql_select_db('test', $link);
