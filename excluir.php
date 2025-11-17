<?php
include 'conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM clientes WHERE id = $id";

if (mysqli_query($conexao, $sql)) {
    header("Location: informacao.php");
} else {
    echo "Erro: " . mysqli_error($conexao);
}
?>


