

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
       include('inc/conecta.php');

    //    $sql = "SELECT * FROM `contatos`";
    //    $queryContatos = mysql_query($sql);
       
          $nome =  $_POST['nome'];
          $telefone =  $_POST['telefone'];
          $email =  $_POST['email'];
          $foto = $_FILES['foto'];
          $nome_foto = mover_foto($foto);
          $sql = "INSERT INTO `contatos`(`nome`,`telefone`, `email`, `foto`) VALUES ('$nome','$telefone', '$email', '$nome_foto')";
         if( mysql_query($sql)){
            echo "<img src='img/$nome_foto' title='$nome_foto' >";
            mensagem("$nome cadastrado com sucesso", 'success') ;
         }else{
            mensagem("$nome nao foi cadastrado", 'danger') ;
         }
        ?>
      
    </div>
</div>
  <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>


</html>