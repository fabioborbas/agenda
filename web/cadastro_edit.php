<?php
include('inc/conecta.php');
$id = $_GET['id'];

$sql = "SELECT * FROM contatos WHERE idcontatos = $id";

$queryContatos = mysql_query($sql);
if (!$queryContatos) {
    die('Erro na consulta: ' . mysql_error());
}

$linha = mysql_fetch_assoc($queryContatos);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css\create-form.css">
    <title>A.R. Phoenix</title>
</head>

<body>

    <div class="container">
        <header class="header">
            <h1 id="title" class="text-center">Editar Contato</h1>

        </header>
        <div class="form-wrap">
            <div class="row-button">
                <button class="button-x" onclick="window.location.href='index.php'">X</button>
            </div>
            <form id="survey-form" action="update.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="name-label" for="name">Nome</label>
                            <input type="text" id="nome" name="nome" placeholder="Digite seu nome" class="form-control" required value="<?php echo $linha['nome']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="telefone-label" for="telefone">Telefone</label>
                            <input type="text" name="telefone" id="telefone" placeholder="(xx)xxxxx-xxxx" class="form-control" required value="<?php echo $linha['telefone']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="email-label" for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Digite seu email" class="form-control" required value="<?php echo $linha['email']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="foto-label" for="foto">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <button type="submit" id="submit" class="btn btn-primary btn-block" value="Salvar alterações">Enviar</button>
                        <input type="hidden" name="id" value="<?php echo $linha['idcontatos']; ?>">
                    </div>
                </div>

            </form>
        </div>
    </div>
</body>
<script src="js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
<script>
    $(document).ready(function() {
        // Aplica a máscara ao campo de telefone
        $('#telefone').inputmask('(99)99999-9999');
    });
</script>

</html>