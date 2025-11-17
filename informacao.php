<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="informacao.css"> <title>Pesquisa de Clientes</title>
</head>
<body>

    <div class="main-content">
        <div class="form-container">
            <form action="informacao.php" method="POST">
                <h3>Pesquisar Cliente</h3>
                <div class="input-group">
                    <label for="nome">Digite o nome da pessoa:</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite o nome aqui">
                </div>
                <div class="button-group">
                    <input type="submit" name="buscar" value="Pesquisar" class="btn-primary">
                    <a href="cadastro_C/cadastro_cliente.php" class="btn-secondary">Cadastro</a>
                </div>
            </form>
        </div>

        <div class="resultado-container">
            <?php
            //Banco de dados
            include_once("conexao.php");

            if (isset($_POST['buscar'])){
                $nome = trim($_POST['nome']); 

                $sql = "SELECT id, nome, email, telefone, endereco FROM clientes WHERE nome LIKE ?";
                
                $stmt = mysqli_prepare($conexao, $sql);
                
                $nome_busca = '%' . $nome . '%';
                mysqli_stmt_bind_param($stmt, "s", $nome_busca);
                
                mysqli_stmt_execute($stmt);
                
                $consulta = mysqli_stmt_get_result($stmt);

                
                $nome_exibicao = htmlspecialchars($nome);

                if (mysqli_num_rows($consulta) < 1){
                    echo "<div class='message error'>Nenhum registro encontrado para o nome: <strong>" . $nome_exibicao . "</strong></div>";
                }
                else {
                    echo "<h3>Resultados Encontrados:</h3>"; 
                    
                    while ($dados = mysqli_fetch_array($consulta)){

                        $id_cliente = htmlspecialchars($dados['id']);
                        echo '<div class="cliente-item">'; 
                            echo "<strong>ID:</strong> " . htmlspecialchars($dados['id']) . "<br>";
                            echo "<strong>NOME:</strong> " . htmlspecialchars($dados['nome']) . "<br>";
                            echo "<strong>EMAIL:</strong> " . htmlspecialchars($dados['email']) . "<br>";
                            echo "<strong>TELEFONE:</strong> " . htmlspecialchars($dados['telefone']) . "<br>";
                            echo "<strong>ENDEREÇO:</strong> " . htmlspecialchars($dados['endereco']) . "<br>";

                            echo "<div class='acoes'>";
                                echo "<a href='editar.php?id=" . $id_cliente . "'>✏️ Editar</a>  "; 
                                echo "<a href='excluir.php?id=" . $id_cliente . "' onclick='return confirm(\"Tem certeza que deseja excluir o cliente " . htmlspecialchars($dados['nome']) . "?\");'>🗑️ Excluir</a>";                            echo "</div>";

                        echo '</div>'; 



                  
    
                    
                    }
                }
                
                mysqli_stmt_close($stmt);
            }
            mysqli_close($conexao);
            ?>
        </div>
    </div>
</body>
</html>