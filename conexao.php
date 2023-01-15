<?php
    // Código de conexão com o banco
    $server = "localhost";
    $user = "root";
    $password = "password";
    $dbname = "zero_games";

    // Código de criação de conexão
    $conectar = mysqli_connect($server,$user,$password,$dbname);

    // if ($conectar = mysqli_connect($server,$user,$password,$dbname)) {
    //     print "<script>alert('CONEXÃO REALIZADA COM SUCESSO!');</script>";
    // }
?>