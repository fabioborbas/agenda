<?php
include('inc/conecta.php');
$registrosPorPagina = 5;
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($paginaAtual - 1) * $registrosPorPagina;

// Consulta SQL para obter os registros da página atual
$sql = "SELECT * FROM `contatos` LIMIT $inicio, $registrosPorPagina";
$queryContatos = mysql_query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>A.R. Phoenix</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>



    <div class="jumbotron">
        <h1 class="display-4">Contatos Agenda</h1>
        <p class="lead">Guarde seu contatos.</p>
        <hr class="my-4">

        <p class="lead">
            <a class="btn btn-primary btn-lg" href="cadastro.php" role="button">Cadastro</a>
            <a class="btn btn-primary btn-lg" href="cadastro.php" role="button">Pesquisar</a>
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
            <tbody>
                <?php while ($contato = mysql_fetch_assoc($queryContatos)) {
                    $id = $contato['idcontatos'];
                    $nomeContato = $contato['nome'];
                ?>

                    <tr>
                        <td><?php echo $contato['nome']; ?></td>
                        <td><?php echo formatarTelefone($contato['telefone']); ?></td>
                        <td><?php echo $contato['email']; ?></td>
                        <td>
                            <a href="cadastro_edit.php?id=<?php echo $id; ?>" class="btn btn-success btn-sm">Editar</a>
                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_confirma" onclick="pegar_dados('<?php echo $id; ?>','<?php echo $nomeContato; ?>')">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
        <ul class="pagination" >
                <?php
                $sqlContagem = "SELECT COUNT(*) AS total FROM contatos";
                $resultContagem = mysql_query($sqlContagem);
                $rowContagem = mysql_fetch_assoc($resultContagem);
                $totalRegistros = $rowContagem['total'];
                $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

                for ($i = 1; $i <= $totalPaginas; $i++) {
                    echo "<li class='page-item " . ($i == $paginaAtual ? 'active' : '') . "'><a class='page-link' href='?pagina=$i'>$i</a></li>";
                }
                ?>
            </ul>
        </nav>


        <div class="modal fade" id="modal_confirma" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="delete.php" method="POST">
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
    </div>
    <script type="text/javascript">
        function pegar_dados(id, nome) {
            document.getElementById('nome_contato').innerHTML = nome
            document.getElementById('idcontatos').value = id
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
<script src="js/script.js"></script>

</html>