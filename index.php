<?php
include("conexao.php");
    if (isset($_POST['login'])) {
        // print "<script>alert('Botão Login Funcionando!');</script>";
        $usuario = $_POST['user'];
        $senha = base64_encode($_POST['password']);

        $pesquisar = $conectar->query("SELECT * FROM usuarios WHERE 
                                      usuario='$usuario' AND senha='$senha'");
        if (@mysqli_num_rows($pesquisar) == 0) {
            print "<script>alert('Usuário não encontrado!')</script>";
        } else {
            print "<script>alert('Login efetuado com sucesso!')</script>";
            $pesquisaSql = $conectar->query("SELECT id FROM usuarios WHERE usuario='$usuario' AND senha='$senha'");
            $res = $pesquisaSql->fetch_object();
            $userId = base64_encode($res->id);
            print "<script>window.location.href = './tela-inicial.php?id=" . $userId ."';</script>";
            
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
    <link rel="stylesheet" href="./assets/css/login.css">
    <title>ZeroGames - Login</title>
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
                        <h1>Bem-Vindo de volta</h1>
                    </div>
                    <input class="campTxt" type="text" name="user" id="user" placeholder="Usuário" maxlength="20" required>
                    <div class="password flex-row">                        
                        <input class="campPassword" type="password" name="password" id="password" placeholder="Senha" maxlength="20" required>
                        <img id="view_password" src="./assets/view_off.png" alt="">
                    </div>
                    <input class="botaoLogin" type="submit" name="login" value="Login">
                    <p class="cadastro">Não possui conta? <a href="./register.php">cadastre-se</a></p>
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
    </script>
</body>
</html>