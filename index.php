<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Home - Kariri Multi Revendedoras</title>
        <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, maximum-scale=1" />
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/unsemantic-grid-responsive.css" rel="stylesheet" media="all" />
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.ico" />
    </head>
    <body>
        <!--Topo do site-->
        <div id="dvTopo">
            <a href="index.php"><img src="img/logoKaririmr.png" alt="Logo Kariri MultiRevendedoras" /></a>
        </div>

        <!--Menu principal do site-->
        <div id="dvMenuTopo">
            <div class="grid-container">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="?pagina=cadastro">Cadastro</a></li>
                    <li><a href="?pagina=categoria">Categorias</a></li>
                    <li><a href="?pagina=termodeuso">Termos de uso</a></li>
                    <li><a href="?pagina=quemsomos">Quem somos</a></li>
                    <li><a href="?pagina=contato">Contato</a></li>                    
                </ul> 
            </div>
        </div>
        <br />
        <!--Conteúdo centro do site-->
        <div id="dvConteudo" class="grid-container">
            <div class="grid-60 mobile-grid-100 suffix-10" id="dvEsquerda">
                <!--Menu Pesquisa-->
                <div class="grid-parent grid-100" id="boxBusca">
                    <input type="text" id="txtBusca" placeholder="Buscar" />
                    <select id="slBusca">
                        <option value="" selected="selected">Selecione</option>
                        <optgroup label="Frutas">
                            <option value="6">Banana</option>
                            <option value="1">Maça</option>
                            <option value="4">Uva</option>
                        </optgroup>
                        <optgroup label="Carnes">
                            <option value="5">Bife</option>
                            <option value="3">Frango</option>
                            <option value="1">Peixe</option>
                        </optgroup>
                    </select>
                    <button id="btnBuscar">Buscar</button>
                </div>
                <?php
                require_once("Util/ResquestPageSite.php");
                ?>
            </div>

            <div class="grid-30 mobile-grid-100" id="dvDireita">
                <!--Redes sociais-->
                <div class="boxDireita grid-parent grid-100" id="iconesSociais">
                    <a href=""><img src="img/social/facebook.png" alt=""/></a>
                    <a href=""><img src="img/social/twitter.png" alt=""/></a>
                    <a href=""><img src="img/social/youtube.png" alt=""/></a>
                    <a href=""><img src="img/social/instagram.png" alt=""/></a>
                </div>


                <!---->
                <div class="boxDireita grid-parent grid-100">
                    <p>Ericlis eh gay</p>
                </div>

                <!---->
                <div class="boxDireita grid-parent grid-100">
                    <p>Luis eh veaco</p>
                    <p>O GP eh top</p>
                </div>
            </div>
        </div>

        <!--Rodapé do site-->
        <div id="dvRodape">
            <div class="grid-container">
                <div class="grid-100">
                    <p>&copy; Kariri Multi Revendedoras- Todos os Direitos Reservados</p>  
                </div>
            </div>
        </div>
    </body>
</html>