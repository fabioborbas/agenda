<?php
include('inc/conecta.php');

$registrosPorPagina = isset($_GET['registrosPorPagina']) ? $_GET['registrosPorPagina'] : 5;
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($paginaAtual - 1) * $registrosPorPagina;
$totalRegistrosQuery = mysql_query("SELECT COUNT(*) as total FROM contatos");
$totalRegistrosArray = mysql_fetch_assoc($totalRegistrosQuery);
$totalRegistros = $totalRegistrosArray['total'];

$sql = "SELECT * FROM `contatos` LIMIT $inicio, $registrosPorPagina";

$queryContatos = mysql_query($sql);

$conteudo = '';
$contatos = array();
while ($contato = mysql_fetch_assoc($queryContatos)) {
    $contatos[] = $contato;
}

// Montar a paginacao
$response = formData($contatos, 200, $totalRegistros, $paginaAtual, $registrosPorPagina);
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
