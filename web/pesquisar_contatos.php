<?php
include('inc/conecta.php');

$termoPesquisa = isset($_GET['termo']) ? $_GET['termo'] : '';
$termoPesquisa = mysql_real_escape_string($termoPesquisa);

$sql = "SELECT * FROM `contatos` WHERE 
        LOWER(`nome`) LIKE '%$termoPesquisa%' OR
        LOWER(`telefone`) LIKE '%$termoPesquisa%' OR
        LOWER(`email`) LIKE '%$termoPesquisa%'
        LIMIT 0, 5";

$queryContatos = mysql_query($sql);

$contatos = array();
while ($contato = mysql_fetch_assoc($queryContatos)) {
    $contatos[] = $contato;
}

$response = formData($contatos, 200, count($contatos), 1, 5);
echo json_encode($response);
exit();

function formData($data, $status, $totalRegistros, $paginaAtual, $registrosPorPagina)
{
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    return array(
        'data' => $data,
        'status' => $status,
        'totalRegistros' => $totalRegistros,
        'totalPaginas' => $totalPaginas,
        'paginaAtual' => $paginaAtual,
    );
}
