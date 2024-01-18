<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>A.R. Phoenix</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <?php
            include('../inc/conecta.php');
            $id = $_POST['id'];
            $nome =  $_POST['nome'];
            $telefone =  $_POST['telefone'];
            $email =  $_POST['email'];
            $foto = $_FILES['foto'];
            echo "Nome da imagem antes de mover dentro da api: $foto[name]";
            // Verifique se uma nova imagem foi enviada sem erros
            if ($foto['error'] == 0) {
                // Adicione este echo para depurar
                echo "Nova imagem encontrada. Tamanho: $foto[size]";

                // Se sim, faça o upload e obtenha o nome da nova imagem
                $nome_foto = mover_foto($foto);

                // Adicione este echo para depurar
                echo "Nome da nova imagem após mover: $nome_foto";

                // Agora, atualize a entrada no banco de dados, incluindo a nova imagem
                $sql = "UPDATE `contatos` SET `nome` = '$nome', `telefone` = '$telefone', `email` = '$email', `foto` = '$nome_foto' WHERE idcontatos = $id";

                // Adicione este echo para depurar
                echo "SQL Query: $sql";
            } else {
                // Adicione este echo para depurar
                echo "Erro no upload da imagem. Código de erro: $foto[error]";

                // Se nenhuma nova imagem foi enviada ou ocorreu um erro, mantenha o valor atual no banco de dados
                $sql = "UPDATE `contatos` SET `nome` = '$nome', `telefone` = '$telefone', `email` = '$email' WHERE idcontatos = $id";

                // Adicione este echo para depurar
                echo "SQL Query: $sql";
            }

            if (mysql_query($sql)) {
                mensagem("$nome alterado com sucesso", 'success');
            } else {
                mensagem("$nome não foi alterado", 'danger');
            }
            ?>
        </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</body>


</html>