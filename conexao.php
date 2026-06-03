<?php

// conexão do banco de dados

$servername = "localhost";
$username = "root";
$password = "Rb957610@";
$dbname = "supermercado";

$cone = new mysqli($servername, $username, $password, $dbname);

if ($cone->connect_error) {

    die("Conexão falhou: " . $cone->connect_error);

} else {

    //echo "Conectado com sucesso!";

}
