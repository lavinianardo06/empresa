<?php
include 'conexao.php';



$id = $_GET['id'];

$sql = "SELECT id, nome, email, telefone, endereco FROM clientes WHERE id = $id";
$result = mysqli_query($conexao, $sql);


if (!$result) {
    die("Erro na consulta: " . mysqli_error($conexao));
}

$cliente = mysqli_fetch_assoc($result);


if (!$cliente) {
    die("Cliente não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro_C/cadastro_cliente.css"> 
    <title>Editar Cliente</title>
</head>
<body>

    <div class="cadastro-container">
        <div class="inicio">
            <h2>Editar Cliente</h2>
        </div>

        <form class="cadastro-form" method="POST">
            
            <div class="input-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Nome" 
                       value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" 
                       value="<?php echo htmlspecialchars($cliente['email']); ?>" required> 
            </div>

            <div class="input-group">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX" 
                       value="<?php echo htmlspecialchars($cliente['telefone']); ?>" required>
            </div>

            <div class="input-group">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" placeholder="Rua, Número, Bairro" 
                       value="<?php echo htmlspecialchars($cliente['endereco']); ?>" required>
            </div>


            <button type="submit" class="button-entrar" name="salvar_edicao">Salvar Edição</button>
            
            <div class="link-tabela-container">
                <a href="informacao.php" class="link-tabela">Voltar para a Tabela</a>
            </div>
        </form>
    </div>

    <?php
  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
      
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
        $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);

      
        $sql_update = "UPDATE clientes SET 
                        nome='$nome', 
                        email='$email', 
                        telefone='$telefone', 
                        endereco='$endereco' 
                    WHERE id = $id";

        if (mysqli_query($conexao, $sql_update)) {
 
            echo "<script>alert('Cliente atualizado com sucesso!'); window.location.href = 'informacao.php';</script>";
            exit;
        } else {
        
            echo "Erro ao atualizar: " . mysqli_error($conexao);
        }
    }
    ?>
</body>
</html>