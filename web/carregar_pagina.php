<?php
include('inc/conecta.php');

$registrosPorPagina = 5;
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($paginaAtual - 1) * $registrosPorPagina;

$sql = "SELECT * FROM `contatos` LIMIT $inicio, $registrosPorPagina";
$queryContatos = mysql_query($sql);

// Montar o conteúdo da tabela
$conteudo = '';
$contatos = array();
while ($contato = mysql_fetch_assoc($queryContatos)) {
    $contatos[] = $contato;
}

// Montar a paginacao
$totalRegistros = mysql_num_rows(mysql_query("SELECT * FROM contatos"));
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

$paginacao = '';
for ($i = 1; $i <= $totalPaginas; $i++) {
    $paginacao .= "<li class='page-item " . ($i == $paginaAtual ? 'active' : '') . "'><a class='page-link' href='#' data-page='{$i}'>$i</a></li>";
}

$response = formData($contatos, 200, $totalRegistros);

echo json_encode($response);
exit();

function formData($data, $status, $totalRegistros)
{
    return array(
        'data' => $data,
        'status' => $status,
        'totalRegistros' => $totalRegistros,
    );
}
