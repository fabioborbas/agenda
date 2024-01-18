<?php
include('../inc/conecta.php');

$nome =  $_POST['nome'];
$telefone =  $_POST['telefone'];
$email =  $_POST['email'];
$foto = $_FILES['foto'];
$nome_foto = mover_foto($foto);
$sql = "INSERT INTO `contatos`(`nome`,`telefone`, `email`, `foto`) VALUES ('$nome','$telefone', '$email', '$nome_foto')";

if (mysql_query($sql)) {
    header('Location: ../index.php?mensagem=' . urlencode("$nome cadastrado com sucesso") . '&tipo=success');
    exit();
} else {
    header('Location: ../index.php?mensagem=' . urlencode("$nome não foi cadastrado") . '&tipo=danger');
    exit();
}
