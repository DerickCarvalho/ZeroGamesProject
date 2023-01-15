<?php
include("conexao.php");
    if (isset($_POST['cadastrar'])) {
        // print "<script>alert('Botão Cadastrar Funcionando!');</script>";
        $nome = $_POST['nome'];
        $usuario = $_POST['user'];
        $senha = base64_encode($_POST['password']);
        $confirmarSenha = base64_encode($_POST['confirm_password']);

        $pesquisa = $conectar->query("SELECT * FROM usuarios WHERE 
                                      usuario='$usuario' AND senha='$senha'");
        if ($senha != $confirmarSenha) {
            print "<script>alert('Os campos de senhas possuem valores diferentes!');</script>";
        } else if (@mysqli_num_rows($pesquisa) != 0) {
            print "<script>alert('Os dados informados já existem no sistema!');</script>";
        } else {
            $sql = "INSERT INTO usuarios (nome,usuario,senha) VALUES
                    ('$nome','$usuario','$senha')";
            $res = $conectar->query($sql);

            if ($res==true) {
                print "<script>alert('Usuário cadastrado com sucesso!');</script>";
                print "<script>location.href='./index.php';</script>";
            } else {
                print "<script>alert('ERRO!');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/logo_pequena.png">
    <link rel="stylesheet" href="./assets/css/register.css">
    <title>ZeroGames - Register</title>
</head>
<body>
    <header>
        <div class="container flex-row">
            <img src="./assets/logo.png" alt="">
        </div>
    </header>

    <main>
        <div class="container flex-row">            
            <div class="formulario flex-row">
                <div class="form_description flex-column">
                    <img src="./assets/logo_pequena.png" alt="">
                    <img src="./assets/logo.png" alt="">
                    <p>Tenha controle sobre sua jogatina</p>
                </div>

                <form class="flex-column" action="" method="POST">
                    <div class="form_header flex-row">
                        <h1>Bem-Vindo ao ZG!</h1>
                    </div>
                    <input class="campTxt" type="text" name="nome" id="nome" placeholder="Nome" maxlength="30" required>
                    <input class="campTxt" type="text" name="user" id="user" placeholder="Usuário" max="20" required>
                    <div class="password flex-row">                        
                        <input class="campPassword" type="password" name="password" id="password" placeholder="Senha" max="20" required>
                        <img id="view_password" src="./assets/view_off.png" alt="">
                    </div>
                    
                    <div class="password flex-row">                        
                        <input class="campPassword" type="password" name="confirm_password" id="confirm_password" placeholder="Confirmar Senha" maxlength="20" required>
                        <img id="view_confirmPassword" src="./assets/view_off.png" alt="">
                    </div>
                    <input class="botaoLogin" type="submit" name="cadastrar" value="Cadastrar-se">
                    <p class="cadastro">Já possúi uma conta? <a href="./login.php">login</a></p>
                    <p class="credits flex-row">
                        &copy;2022.2 - Derick Carvalho
                    </p>
                </form>
            </div>
        </div>
    </main>

    <script>
        let booleanSenha = 0; // Variável booleana para verificar se a senha está ou não visível
        let campoSenha = document.getElementById('password'); // Adiciona o input password à variável
        let buttonPassword = document.getElementById('view_password'); // Adiciona img que servirá como botão
        buttonPassword.addEventListener('click', () => {
            if (booleanSenha == 0) {
                buttonPassword.src = "./assets/view_on.png";
                campoSenha.type = "text";
                booleanSenha = 1;
            } else {
                buttonPassword.src = "./assets/view_off.png";
                campoSenha.type = "password";
                booleanSenha = 0;
            }
        });

        let booleanConfirmSenha = 0; // Variável booleana para verificar se a senha está ou não visível
        let campoConfirmSenha = document.getElementById('confirm_password'); // Adiciona o input password à variável
        let buttonConfirmPassword = document.getElementById('view_confirmPassword'); // Adiciona img que servirá como botão
        buttonConfirmPassword.addEventListener('click', () => {
            if (booleanConfirmSenha == 0) {
                buttonConfirmPassword.src = "./assets/view_on.png";
                campoConfirmSenha.type = "text";
                booleanConfirmSenha = 1;
            } else {
                buttonConfirmPassword.src = "./assets/view_off.png";
                campoConfirmSenha.type = "password";
                booleanConfirmSenha = 0;
            }
        });
    </script>
</body>
</html>