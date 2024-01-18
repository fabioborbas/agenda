<?php
include('../inc/conecta.php');
$id = $_POST['id'];
$nome =  $_POST['nome'];

$sql = "DELETE from `contatos` WHERE idcontatos = $id";
if (mysql_query($sql)) {
    header('Location: ../index.php?mensagem=' . urlencode("$nome excluído com sucesso") . '&tipo=success');
    exit();
} else {
    header('Location: ../index.php?mensagem=' . urlencode("$nome não foi excluído") . '&tipo=danger');
    exit();
}
