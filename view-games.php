<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/logo_pequena.png">
    <link rel="stylesheet" href="./assets/css/games.css">
    <title>ZeroGames - Games</title>
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
                        <li><p><a href="./cad-game.php?id=<?php print "$userId" ?>">Cadastrar Jogo</a></p></li>
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
            <li><p><a href="./cad-game.php?id=<?php print "$userId" ?>">Cadastrar Jogo</a></p></li>
            <li><p><a href="./tela-user.php?id=<?php print "$userId" ?>">Perfil</a></p></li>
        </ul>
    </nav>

    <main class="content flex-column">
        <?php
            $queryListar = ("SELECT * FROM jogos WHERE id_jogador='$usu_id' ORDER BY id DESC");
            $listarJogos = $conectar->query($queryListar);
            $resListJogos = $listarJogos->num_rows;

            print "<h3>Lista de Jogos Zerados</h1>";

            if ($resListJogos > 0) {
                while (($resLista = $listarJogos->fetch_object())) {
                    print "<section style=\"border: 2px solid #282828; padding: 10px; border-radius: 15px;\" class=\"comunity_game flex-row\">";
                    print "<div class=\"img_game\">";
                    print "<img src=\"$resLista->img_url\">";
                    print "</div>";
                        
                    print "<div class=\"title_and_user flex-column\">";
                    print "<h1>$resLista->nome_jogo</h1><h1 style=\"padding:0;\">| $resLista->horas_jogadas Horas |</h1>";
                    print "</div>";
                    print "</section>";
                }
            } else {
                print "<section style=\"border: 2px solid #282828; padding: 10px; border-radius: 15px;\" class=\"comunity_game flex-row\">";
                print "<div class=\"img_game\">";
                print "<img src=\"https://www.freeiconspng.com/thumbs/load-icon-png/loading-icon-1.png\">";
                print "</div>";
                        
                print "<div class=\"title_and_user flex-column\">";
                print "<h1>Nenhum jogo encontrado</h1><h1 style=\"padding:0;\">| 000 Horas |</h1>";
                print "</div>";
                print "</section>";
            }
        ?>
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