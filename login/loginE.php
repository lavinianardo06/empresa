<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login - Empregado</title>
</head>
<body>

    <div class="login-container">
        <div class="header">
            <h2>Acesso do Empregado</h2>
        </div>

        <form class="login-form" action="loginE.php" method="POST">
            
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="inputEmail" placeholder="Seu email" required> 
            </div>

            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="inputSenha" placeholder="Sua senha" required> 
            </div>

            <button type="submit" class="button-entrar" name="login">Entrar</button>
            
            <div class="links-adicionais">
                <p>Não tem conta? <a href="cadastro_empregado.php">Cadastre-se</a></p>
                <p><a href="#">Esqueci minha senha</a></p>
            </div>
        </form>
    </div>
</body>
</html>

<?php

include_once("../conexao.php");


if (isset($_POST['login'])) {

    $email = $_POST['inputEmail'];
    $senha = $_POST['inputSenha']; 


    $sql = "SELECT id, nome, senha FROM empregado WHERE email = ?";
    
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) === 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        

        if ($senha === $usuario['senha']) { 

            $_SESSION['empregado_id'] = $usuario['id'];
            $_SESSION['empregado_nome'] = $usuario['nome'];
            

            header("Location: ../informacao.php");
            exit();
            
        } else {
            // Senha incorreta
            echo "<script>alert('Senha incorreta!');
                 window.location.href = 'loginE.php';</script>";
        }
    } else {
        // Usuário não encontrado 
        echo "<script>alert('E-mail não cadastrado!');
               window.location.href = 'loginE.php';</script>";
    }
    
    mysqli_stmt_close($stmt);
}
mysqli_close($conexao);
?>