<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexao.php';

$nome = $_POST['nome'];
$categoria = $_POST['categoria'];
$quantidade = $_POST['quantidade'];
$preco = $_POST['preco'];

$sql = "INSERT INTO produtos( nome, categoria, quantidade,preco) VALUES ('$nome', '$categoria', $quantidade, $preco)";

if ($cone->query($sql) === TRUE) {

    header("Location: index.php?sucesso=1");
    exit();

} else {

    echo "Erro: " . $cone->error;
}