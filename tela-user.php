<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/logo_pequena.png">
    <link rel="stylesheet" href="./assets/css/profile.css">
    <title>ZeroGames - Profile</title>
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
    $resultadoUser = $exeUser->num_rows;
    $resUser = $exeUser->fetch_object();

    if (isset($_POST['new_url'])) {
        $new_url = $_POST['new_img'];

        $update = $conectar->query("UPDATE usuarios SET url_img = '$new_url' WHERE
                                        id = '$usu_id'");
        print "<script>alert('Imagem de perfil alterada com sucesso!')</script>";
        print "<script>window.location.href = './tela-inicial.php?id=".$userId."'</script>";
    }
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
                        <li><p><a href="./view-games.php?id=<?php print "$userId" ?>">Ver Meus Jogos</a></p></li>
                    </ul>
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
            <li><p><a href="./view-games.php?id=<?php print "$userId" ?>">Ver Meus Jogos</a></p></li>
        </ul>
    </nav>

    <main class="flex-column">
        <section class="change_profile flex-column">
            <?php
                if (($resUser->url_img) == "") {
                    print "<img src=\"./assets/user_default.png\"/>";
                } else {
                    print "<img src=\"$resUser->url_img\">";
                }
                print "<h1>$resUser->usuario</h1>";
                print "<p>URL da nova imagem de perfil:</p>";

                print "<form method=\"POST\" class=\"flex-column\">";
                    print "<input class=\"img_url\" type=\"text\" name=\"new_img\" maxlength=\"600\" required/>";
                    print "<input class=\"form_buttom\" type=\"submit\" name=\"new_url\"/>";
                print "</form>";          
            ?>
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
                menuOptions.style.marginTop = '-150px';
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
    </script>
</body>
</html>