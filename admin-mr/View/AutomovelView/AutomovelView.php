<?php
require_once ("../Controller/AutomovelController.php");
require_once("../Model/Categoria.php");
require_once ("../Model/Automovel.php");
require_once("../Controller/CategoriaController.php");
$categoriaController = new CategoriaController();
$listaCategoria = $categoriaController->RetornarCategorias();
$automovelController = new AutomovelController();

$cod = 0;
$nome = "";
$descricao = "";
$placa = "";
$renavam = "";
$marca = "";
$modelo = "";
$ano = "";
$categoria = 9;


$resultado = "";
$spResultadoBusca = "";
$listaAutomoveisBusca = [];

if (filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)) {
    $automovel = new Automovel();

    $automovel->setNome(filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING));
    $automovel->setDescricao(filter_input(INPUT_POST, "txtDescricao", FILTER_SANITIZE_STRING));
    $automovel->setPlaca(filter_input(INPUT_POST, "txtPlaca", FILTER_SANITIZE_STRING));
    $automovel->setRenavam(filter_input(INPUT_POST, "txtRenavam", FILTER_SANITIZE_STRING));
    $automovel->setMarca(filter_input(INPUT_POST, "txtMarca", FILTER_SANITIZE_STRING));
    $automovel->setModelo(filter_input(INPUT_POST, "txtModelo", FILTER_SANITIZE_STRING));
    $automovel->setAno(filter_input(INPUT_POST, "txtAno", FILTER_SANITIZE_STRING));
//    $automovel->setCategoria(filter_input(INPUT_POST, "slCategoria", FILTER_SANITIZE_NUMBER_INT));
    $automovel->setCategoria(9);

    if (!filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT)) {
        //Cadastrar

        if ($automovelController->Cadastrar($automovel)) {
            ?>
            <script>
                document.cookie = "msg=1";
                document.location.href = "?pagina=automovel";
            //Script para evitar que o banco seja cadastrado toda vez que recarregar a pagina. 
            //o Cookie redirecionara para a pagina de automovel.
            </script>
            <?php
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar cadastrar o automovel.</div>";
        }
    } else {
        //Editar
        $automovel->setCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));

        if ($automovelController->Alterar($automovel)) {
            ?>
            <script>
                document.cookie = "msg=2";
                document.location.href = "?pagina=automovel";
            //Script para evitar que o banco seja cadastrado toda vez que recarregar a pagina. 
            //o Cookie redirecionara para a pagina de automovel.
            </script>
            <?php
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar alterar o automóvel.</div>";
        }
    }
}

//Buscar usuários

if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {

    $termo = filter_input(INPUT_POST, "txtTermo", FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, "slTipoBusca", FILTER_SANITIZE_NUMBER_INT);
    $listaAutomoveisBusca = $automovelController->RetornarAutomoveis($termo, $tipo);

    if ($listaAutomoveisBusca != null) {
        $spResultadoBusca = "Exibindo dados";
    } else {
        $spResultadoBusca = "Dados não encontrado";
    }
} else if (filter_input(INPUT_POST, "btnBuscarTudo", FILTER_SANITIZE_STRING)) {


    $listaAutomoveisBusca = $automovelController->RetornarTodosAutomoveis();
}

if (filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT)) {
    $retornoAutomovel = $automovelController->RetornaCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));

    $cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
    $nome = $retornoAutomovel->getNome();
    $descricao = $retornoAutomovel->getDescricao();
    $placa = $retornoAutomovel->getPlaca();
    $renavam = $retornoAutomovel->getRenavam();
    $marca = $retornoAutomovel->getMarca();
    $modelo = $retornoAutomovel->getModelo();
    $ano = $retornoAutomovel->getAno();
    $categoria = $retornoAutomovel->getCategoria();
}

?>


<!DOCTYPE html>
<div id="dvAutomovelView">
    <h1>Gerenciar Automoveis</h1>
    <br />
    <div class="controlePaginas">
        <a href="?pagina=automovel"><img src="img/icones/editar.png" alt=""/></a>
        <a href="?pagina=automovel&consulta=s"><img src="img/icones/buscar.png" alt=""/></a>
    </div>

    <br />
    <!--DIV CADASTRO -->
    <?php
    if (!filter_input(INPUT_GET, "consulta", FILTER_SANITIZE_STRING)) {
        ?>
        <div class="panel panel-default maxPanelWidth">
            <div class="panel-heading">Cadastrar e editar</div>
            <div class="panel-body">
                <form method="post" id="frmGerenciarAutomovel" name="frmGerenciarAutomovel" novalidate>

                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <input type="hidden" id="txtCodAutomovel" value="<?= $cod; ?>" />
                                <label for="txtNome">Nome do automovel:</label>
                                <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome do autmovel" value="">
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
                                <label for="txtUsuario">Placa:</label>
                                <input type="text" class="form-control" id="txtPlaca" name="txtPlaca" placeholder="placa"  value="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
                                <label for="txtMarca">Marca:</label>
                                <input type="text" class="form-control" id="txtMarca" name="txtMarca" placeholder="marca"  value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
                                <label for="txtModelo">Modelo:</label>
                                <input type="text" class="form-control" id="txtModelo" name="txtModelo" placeholder=""  value="">
                            </div>
                        </div>
                        <div class="col-lg-2 col-xs-12">
                            <div class="form-group">
                                <label for="txtAno">Ano:</label>
                                <input type="text" class="form-control" id="txtAno" name="txtAno" placeholder="" />
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-12">
                            <div class="form-group">
                                <label for="txtRenavam">Renavam:</label>
                                <input type="text" class="form-control" id="txtRenavam" name="txtRenavam" placeholder=""/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
                                <label for="slCategoria">Categoria</label>
                                <select class="form-control" id="slCategoria" name="slCategoria">
                                    <option value="">Selecione</option>
                                    <?php
                                    foreach ($listaCategoria as $cat) {
                                        ?>
                                        <option value="<?= $cat->getCod() ?>" <?= ($ctg == $cat->getCod() ? "selected='selected'" : "") ?> <?= ($cat->getSubcategoria() == null ? "style='font-weight: bold;'" : "") ?>><?= $cat->getNome() ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <p style="font-weight: 700;">Descrição</p>
                            <textarea class="form-control" id="txtDescricao" name="txtDescricao"></textarea>
                        </div>
                    </div>
            </div>
            <input class="btn btn-success" type="submit" name="btnGravar" value="Gravar">
            <a href="#" class="btn btn-danger">Cancelar</a>

            <br />
            <br />    
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul id="ulErros"></ul>
            </div>
        </div>
    </form>
    </div>
    </div>
    <?php
} else {
    ?>
    <br />
    <!--DIV CONSULTA -->
    <div class="panel panel-default maxPanelWidth">
        <div class="panel-heading">Consultar</div>
        <div class="panel-body">
            <form method="post" name="frmBuscarAutomovel" id="frmBuscarAutomovel">
                <div class="row">
                    <div class="col-lg-8 col-xs-12">
                        <div class="form-group">
                            <label for="txtTermo">Termo de busca</label>
                            <input type="text" class="form-control" id="txtTermo" name="txtTermo" placeholder="Ex: camaro amarelo" />
                        </div>
                    </div>

                    <div class="col-lg-4 col-xs-12">
                        <div class="form-group">
                            <label for="slTipoBusca">Tipo</label>
                            <select class="form-control" id="slTipoBusca" name="slTipoBusca">
                                <option value="1">Nome</option>
                                <option value="2">Marca</option>
                                <option value="3">Modelo</option>
                                <option value="4">Categoria</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <input class="btn btn-info" type="submit" name="btnBuscar" value="Buscar"> 
                        <span><?= $spResultadoBusca; ?></span>
                        <input class="btn btn-success" type="submit" name="btnBuscarTudo" value="Buscar Todos"> 

                    </div>

                </div>
            </form>

            <hr />
            <br />

            <table class="table table-responsive table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Categoria</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($listaAutomoveisBusca != null) {
                        foreach ($listaAutomoveisBusca as $auto) {
                            ?>
                            <tr>
                                <td><?= $auto->getNome(); ?></td>
                                <td><?= $auto->getMarca(); ?></td>
                                <td><?= $auto->getModelo(); ?></td>
                                <td><?= $auto->getAno(); ?></td>
                                <td><?= $auto->getCategoria(); ?></td>
                                <td>
                                    <a href="?pagina=visualizarautomovel&cod=<?= $auto->getCod(); ?>" class="btn btn-success">Visualizar</a>
                                    <a href="?pagina=automovel&cod=<?= $auto->getCod(); ?>" class="btn btn-warning">Editar</a>                                                
                                    <a href="?pagina=alterarsenha&cod=<?= $auto->getCod(); ?>" class="btn btn-danger">Senha</a>
                                    <a href="?pagina=endereco&cod=<?= $auto->getCod(); ?>" class="btn btn-info">Endereço</a>
                                    <a href="?pagina=telefone&cod=<?= $auto->getCod(); ?>" class="btn btn-primary">Telefone</a>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}
?>
</div>
<script src="../js/mask.js" type="text/javascript"></script>


<script>
    $(document).ready(function () {
    CKEDITOR.replace('txtDescricao');
            if (getCookie("msg") == 1) {
    document.getElementById("pResultado").innerHTML = "<div class=\"alert alert-success\" role=\"alert\">Usuário cadastrado com sucesso.</div>";
            document.cookie = "msg=d";
    } else if (getCookie("msg") == 2) {
    document.getElementById("pResultado").innerHTML = "<div class=\"alert alert-success\" role=\"alert\">Usuário alterado com sucesso.</div>";
            document.cookie = "msg=d";
    }
</script>
