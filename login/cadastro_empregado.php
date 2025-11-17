<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro_empregado.css">
    <title>Cadastro-Do-empregado</title>
</head>
<body>

    <div class="cadastro-container">
        <div class="inicio">
            <h2>Cadastro do Empregado</h2>
        </div>

        <form class="cadastro-form" action="cadastro_empregado.php" method="POST">
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

            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="inputSenha" placeholder="Digite sua senha" required> 
            </div>
           
            <button type="submit" class="button-entrar" name="enviar">Enviar</button>
             <p>Ja tenho conta? <a href="loginE.php">Volta</a></p>

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
    $senha = $_POST['inputSenha'];

    $inset = "INSERT INTO empregado (id, nome, email, telefone, endereco,senha)
            VALUES ('','$nome', '$email', '$telefone', '$endereco',$senha )";

    $consultar = mysqli_query($conexao, $inset);


    if ($consultar) {
        echo "<script>
            alert('empregado cadastrado com sucesso!');
             window.location.href = 'loginE.php';
          </script>";
    } else {
        echo "<script>alert('Erro ao cadastrar empregado: " . mysqli_error($conexao) . "');</script>";
    }
}

exit; 
?>