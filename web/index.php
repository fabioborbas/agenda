<?php
if (isset($_GET['mensagem']) && isset($_GET['tipo'])) {
    $mensagem = htmlspecialchars($_GET['mensagem']);
    $tipo = htmlspecialchars($_GET['tipo']);

    echo '<div class="alert alert-' . $tipo . ' alert-dismissible fade show" role="alert">';
    echo $mensagem;
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    echo '<span aria-hidden="true">&times;</span>';
    echo '</button>';
    echo '</div>';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>A.R. Phoenix</title>
</head>

<body>
    <div class="jumbotron">
        <h1 class="display-4">Contatos Agenda</h1>
        <p class="lead">Guarde seus contatos.</p>
        <hr class="my-4">

        <p class="lead">
            <a class="btn btn-primary btn-lg" href="pages/cadastro.php" role="button">Cadastro</a>
            <a class="btn btn-primary btn-lg" href="pages/cadastro.php" role="button">Pesquisar</a>
        </p>
    </div>

    <div class="container">
        <h1>Contatos</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Funções</th>
                </tr>
            </thead>
            <tbody id="conteudo-tbody">
                <!-- O conte�do ser� carregado dinamicamente aqui -->
            </tbody>
        </table>
        <div style="display: flex; justify-content: space-between;">
            <select style="height: max-content;" id="select-list">
                <option selected value="5">5</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <ul id="pagination" class="pagination justify-content-center">
                <!-- Os itens da barra de navega��o ser�o adicionados dinamicamente aqui -->
            </ul>

        </div>
    </div>

    <div class="modal fade" id="modal_confirma" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="api/delete.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Excluir Contato</h1>
                    </div>
                    <div class="modal-body">
                        <p>Deseja excluir <b id="nome_contato">nome</b>? </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                        <input type="hidden" name="id" id="idcontatos" value="">
                        <input type="submit" class="btn btn-danger" value="Sim"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>