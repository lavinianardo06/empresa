<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro_cliente.css">
    <title>Cadastro-Cliente</title>
</head>
<body>

    <div class="cadastro-container">
        <div class="inicio">
            <h2>Cadastro do Cliente</h2>
        </div>

        <form class="cadastro-form" action="cadastro_cliente.php" method="POST">
            <div class="input-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="inputNome" placeholder="Nome" required>
            </div>

            <div class="input-group">
                 <label for="email">Email</label>
                <input type="email" id="email" name="inputEmail" placeholder="Email" required> 
            </div>

            <div class="input-group">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="inputTelefone" placeholder="(XX) XXXXX-XXXX" required>
            </div>

            <div class="input-group">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="inputEndereco" placeholder="Rua, Número, Bairro" required>
            </div>


            <button type="submit" class="button-entrar" name="enviar">Enviar</button>
            <div class="link-tabela-container">
               <a href="../informacao.php" class="link-tabela">Tabela</a>
            </div>
        </form>
    </div>
</body>
</html>


<?php


include_once("../conexao.php");//banco de daods

if (isset($_POST['enviar'])){
    $nome = $_POST['inputNome'];
    $email = $_POST['inputEmail'];
    $telefone = $_POST['inputTelefone']; 
    $endereco = $_POST['inputEndereco']; 

    

    $inset = "INSERT INTO clientes (nome, email, telefone, endereco)
            VALUES ('$nome', '$email', '$telefone', '$endereco' )";

    $consultar = mysqli_query($conexao, $inset);


    if ($consultar) {
        echo "<script>
            alert('Cliente cadastrado com sucesso!');
      
          </script>";
    } else {
        echo "<script>alert('Erro ao cadastrar cliente: " . mysqli_error($conexao) . "');</script>";
    }
}

?>