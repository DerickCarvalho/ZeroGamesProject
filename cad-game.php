<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/logo_pequena.png">
    <link rel="stylesheet" href="./assets/css/register-game.css">
    <title>ZeroGames - Register Game</title>
</head>
<body>
<?php
    include("conexao.php");
    $userId = $_REQUEST["id"];
    $usu_id = base64_decode($userId);

    $pesquisaUltimoJogo = ("SELECT * FROM jogos WHERE id_jogador=".$usu_id." ORDER BY id DESC LIMIT 1 ");
    $res = $conectar->query($pesquisaUltimoJogo);
    $resultadoQuery = $res->num_rows;
    $row = $res->fetch_object();
    
    $pesquisaUser = ("SELECT * FROM usuarios WHERE id=".$usu_id);
    $exeUser = $conectar->query($pesquisaUser);
    $resUser = $exeUser->fetch_object();
?>
    <header>
        <div class="container flex-row space-between">
            <div id="site" class="img_header">
                <img src="./assets/logo.png" alt="">
            </div>

            <nav class="menu flex-row">
                <div class="menu_header flex-row">
                    <ul class="flex-row">
                        <li><p><a href="./view-games.php?id=<?php print "$userId" ?>">Ver Meus Jogos</a></p></li>
                    </ul>

                    <div id="user" class="user flex-row">
                        <?php
                            if (($resUser->url_img) != "") {
                                print "<img src=\"$resUser->url_img\">";
                                print "<h3>$resUser->usuario</h3>";
                            } else {
                                print "<img src=\"./assets/user_default.png\">";
                                print "<h3>$resUser->usuario</h3>";
                            }
                        ?>
                    </div>
                </div>

                <div class="menu-hidden flex-column">
                    <div class="hamburguer" onclick="menu_hamburguer()">
                        <div id="top" class="top"></div>
                        <div id="mid" class="mid"></div>
                        <div id="footer" class="footer"></div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <nav id="menuOptions" class="menu_options">
        <ul>
            <li><p><a href="./view-games.php?id=<?php print "$userId" ?>">Ver Meus Jogos</a></p></li>
            <li><p><a href="./tela-user.php?id=<?php print "$userId" ?>">Perfil</a></p></li>
        </ul>
    </nav>

    <?php    
        if (isset($_POST['cad-jogo'])) {

            $nomeJogo = $_POST['nome-jogo'];
            $horasJogadas = $_POST['horas-jogadas'];
            $urlImagem = $_POST['url-img'];
            $nomeJogador = $resUser->usuario;

            if ($urlImagem == "") {
                $cadQuery = ("INSERT INTO jogos (nome_jogo,img_url,horas_jogadas,id_jogador,nome_jogador) VALUES ('$nomeJogo','https://www.freeiconspng.com/thumbs/load-icon-png/loading-icon-1.png','$horasJogadas','$usu_id','$nomeJogador')");
                $cadastrar = $conectar->query($cadQuery);
                if ($cadastrar == true) {
                    print "<script>alert('Jogo adicionado com sucesso!'); alert('O.B.S.: Não foi adicionado nenhuma URL de imagem');</script>";
                    print "<script>window.location.href = './view-games.php?id=" . $userId ."';</script>";
                }
                
            } else {
                $cadQuery = ("INSERT INTO jogos (nome_jogo,img_url,horas_jogadas,id_jogador,nome_jogador) VALUES ('$nomeJogo','$urlImagem','$horasJogadas','$usu_id','$nomeJogador')");
                $cadastrar = $conectar->query($cadQuery);
                if ($cadastrar == true) {
                    print "<script>alert('Jogo adicionado com sucesso!');window.location.href='./view-games.php?id=" . $userId . "';</script>";
                }
            }
        }
    ?>

    <main class="flex-column">
        <section class="cadastrar_jogo flex-column">
            <h1>Cadastrar Jogo</h1>
            <form class="flex-column" method="POST">
                <input type="text" class="formTxt" name="nome-jogo" id="" placeholder="Nome do Jogo" required maxlength="200">
                <input type="number" class="formTxt" name="horas-jogadas" id="" placeholder="Horas Jogadas" required>
                <input type="text" class="formTxt"  name="url-img" id="" placeholder="URL da Imagem" maxlength="600">
                <input type="submit" value="Cadastrar" name="cad-jogo" class="form-buttom">
            </form>
        </section>
    </main>

    <footer>
        <div id="containerFooter" class="container flex-row space-around">
            <div class="site_credits flex-column">
                <img src="./assets/logo_pequena.png" alt="">
                <img src="./assets/logo.png" alt="">
                <p>&copy;2022.2 - Zero Games</p>
            </div>

            <div class="creator_credits flex-column">
                <h1>Developed by - Derick Carvalho</h1>
                <div id="github" class="social-media flex-row">
                    <img src="./assets/git.png" alt="">
                    <h1>GitHub</h1>
                </div>

                <div id="linkedin" class="social-media flex-row">
                    <img src="./assets/linkedin.png" alt="">
                    <h1>LinkedIn</h1>
                </div>
                <p>&copy;2022.2 - Derick Carvalho</p>
            </div>
        </div>
    </footer>

    <script>
        let topLine = document.getElementById('top');        
        let midLine = document.getElementById('mid');
        let footerLine = document.getElementById('footer');
        let menuOptions = document.getElementById('menuOptions');
        let boolean = 0;
        function menu_hamburguer() {
            if (boolean == 0) {
                midLine.style.display = 'none';
                topLine.style.rotate = '45deg';
                footerLine.style.rotate = '-45deg';
                footerLine.style.marginTop = '-2px';
                menuOptions.style.transition = 'linear margin-top 0.5s';
                menuOptions.style.marginTop = '-100px';
                boolean = 1;
            } else {                
                midLine.style.display = 'block';
                topLine.style.rotate = '0deg';
                footerLine.style.rotate = '0deg';
                footerLine.style.marginTop = '0';
                menuOptions.style.marginTop = '-500px';
                boolean = 0;
            }
        }

        document.getElementById('site').addEventListener('click', () => { // Botão Home (Logo do site)
            location.href = './tela-inicial.php?id=<?php print "$userId" ?>';
        });

        document.getElementById('user').addEventListener('click', () => { // Botão Usuário (Foto de perfil)
            location.href = './tela-user.php?id=<?php print "$userId" ?>';
        });

        document.getElementById('github').addEventListener('click', () => {
            location.href = 'https://github.com/DerickCarvalho';
        });

        document.getElementById('linkedin').addEventListener('click', () => {
            location.href = 'https://www.linkedin.com/in/derick-carvalho-3a0ba9216/';
        });
    </script>
</body>
</html>