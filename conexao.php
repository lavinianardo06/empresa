
<?php


$host = "localhost";
$usuario = "root";
$senha = "abcd1234";
$bd = "empresa";

$conexao = mysqli_connect($host, $usuario, $senha, $bd); //  para juntar o banco de dado

if (!$conexao){ // para ver si esta conectado no banco de dados
die ("Erro de conexao" . mysqli_connect_error());
}
else {
  //echo "Conectado ao banco de dados $bd";
}



?>
