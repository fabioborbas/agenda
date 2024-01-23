<?php
include('../inc/conecta.php');
$id = $_GET['id'];
$sql = "SELECT * FROM contatos WHERE idcontatos = $id";
$queryContatos = mysql_query($sql);
$linha = mysql_fetch_assoc($queryContatos);
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/create-form.css">
    <title>A.R. Phoenix</title>
    <style>
        .rounded-image-upload {
            position: relative;
            overflow: hidden;
            width: 120px;
            /* Ajuste conforme necessário */
            height: 120px;
            /* Ajuste conforme necessário */
            border-radius: 50%;
            margin: 0 auto;
            background: #ececec;
            border: 5px solid black;

        }

        .rounded-image-upload input {
            display: block;
            font-size: 20px;
            position: absolute;
            cursor: pointer;
            opacity: 0;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            /* Esta propriedade faz o input ser um círculo */
        }

        #profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1 id="title" class="text-center">Editar Contato</h1>

        </header>
        <div class="form-wrap">
            <div class="row-button">
                <button class="button-x" onclick="voltarParaIndex(<?php echo $paginaAtual; ?>)">X</button>
            </div>
            <form id="survey-form" action="../api/update.php" method="POST" enctype="multipart/form-data">
                <div style="display: flex; justify-content: center;">
                    <div class="form-group">
                        <div class="rounded-image-upload">
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                            <img id="preview-image" src="#" alt="Preview" style="max-width: 100%; max-height: 200px;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="display: flex; justify-content: center;" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 18 18">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                            </svg>
                        </div>
                    </div>
                </div>
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
<script src="../js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
<script>
    $(document).ready(function() {
        $('#telefone').inputmask('(99)99999-9999');
    });
</script>
<script>
    $(document).ready(function() {
        $('#telefone').inputmask('(99)99999-9999');
    });

    function exibirImagem() {
        var nomeFoto = "<?php echo $linha['foto']; ?>";

        if (nomeFoto !== "") {
            var urlImagem = "../img/" + nomeFoto;
            $('#preview-image').attr('src', urlImagem).show();
        }
    }

    function voltarParaIndex() {
        exibirImagem();
        window.location.href = '../index.php';
    }

    const input = document.querySelector('#foto');
    const previewImage = document.querySelector('#preview-image');

    input.addEventListener('change', () => {
        const file = input.files[0];
        const reader = new FileReader();

        reader.addEventListener('load', () => {
            previewImage.setAttribute('src', reader.result);
            previewImage.style.display = 'block';
        });

        reader.readAsDataURL(file);
    });

    // Chamar a fun��o exibirImagem no carregamento inicial
    $(exibirImagem);
</script>

</html>