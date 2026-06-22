<?php

include 'conexao.php';

$id = (int)$_GET['id'];
$sql = "DELETE FROM produtos WHERE id = '$id'";

if(mysqli_query($cone, $sql)){
    // redireciona sem enviar saída antes para evitar erros de cabeçalho
    
    header("Location: produtos.php");
    exit();

} else {
    echo "Erro ao excluir produto: " . mysqli_error($cone);
}


?>