<?php
include('../inc/conecta.php');
$id = $_POST['id'];
$nome =  $_POST['nome'];
$telefone =  $_POST['telefone'];
$email =  $_POST['email'];
$foto = $_FILES['foto'];
if ($foto['error'] == 0) {
    $nome_foto = mover_foto($foto);
    $sql = "UPDATE `contatos` SET `nome` = '$nome', `telefone` = '$telefone', `email` = '$email', `foto` = '$nome_foto' WHERE idcontatos = $id";
    if (mysql_query($sql)) {
        header('Location: ../index.php?mensagem=' . urlencode("$nome editado com sucesso") . '&tipo=success');
        exit();
    } else {
        header('Location: ../index.php?mensagem=' . urlencode("$nome não foi editado") . '&tipo=danger');
        exit();
    }
} else {
    $sql = "UPDATE `contatos` SET `nome` = '$nome', `telefone` = '$telefone', `email` = '$email' WHERE idcontatos = $id";
    if (mysql_query($sql)) {
        header('Location: ../index.php?mensagem=' . urlencode("$nome editado com sucesso") . '&tipo=success');
        exit();
    } else {
        header('Location: ../index.php?mensagem=' . urlencode("$nome não foi editado") . '&tipo=danger');
        exit();
    }
}
