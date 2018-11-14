<!DOCTYPE html>
<html> 
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="fonts/roboto/" rel="stylesheet">
       <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="css/materialize.min.css">
      <!--Let browser know website is optimized for mobile-->
      <script src="https://www.gstatic.com/firebasejs/5.5.5/firebase.js"></script>
      <script src="js/firebase.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      .side-nav .user-view,.side-nav .userView{position:relative;padding:32px 32px 0;margin-bottom:8px}.side-nav .user-view>a,.side-nav .userView>a{height:auto;padding:0}.side-nav .user-view>a:hover,.side-nav .userView>a:hover{background-color:transparent}.side-nav .user-view .background,.side-nav .userView .background{overflow:hidden;position:absolute;top:0;right:0;bottom:0;left:0;z-index:-1}.side-nav .user-view .circle,.side-nav .user-view .name,.side-nav .user-view .email,.side-nav .userView .circle,.side-nav .userView .name,.side-nav .userView .email{display:block}.side-nav .user-view .circle,.side-nav .userView .circle{height:64px;width:64px}.side-nav .user-view .name,.side-nav .user-view .email,.side-nav .userView .name,.side-nav .userView .email{font-size:14px;line-height:24px}.side-nav .user-view .name,.side-nav .userView .name{margin-top:16px;font-weight:500}.side-nav .user-view .email,.side-nav .userView .email{padding-bottom:16px;font-weight:400}.drag-target{height:100%;width:10px;position:fixed;top:0;z-index:998}.side-nav.fixed{left:0;-webkit-transform:translateX(0);transform:translateX(0);position:fixed}.side-nav.fixed.right-aligned{right:0;left:auto}@media only screen and (max-width: 992px){.side-nav.fixed{-webkit-transform:translateX(-105%);transform:translateX(-105%)}.side-nav.fixed.right-aligned{-webkit-transform:translateX(105%);transform:translateX(105%)}.side-nav a{padding:0 16px}.side-nav .user-view,.side-nav .userView{padding:16px 16px 0}
    </style>
    <script>
        window.addEventListener("load", function(event) {
           document.getElementById("container").style.display="block";
           document.getElementById("loadMaterialize").style.display="none";
           //alert("asdasjkdhsakjd");
        });
    </script>
    </head>
    <body onload="carregaDataPicker()">
    <?php include "navbar.php"; ?>
    <div id="loadMaterialize" style="display:block; margin-top: 10%" class="container col s12 m12 l12 preloader-wrapper big active">
        <div class="spinner-layer spinner-green-only center-align">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
    </div>    
    <div id="container" style="display:none" class="row container col s12 m12 l12">
    <h1 id="jorgao" style="display:none"></h1>
    <?php
    if(@$_POST["envio"]=="ok"){
    ?>
    <h1 class="flow-text">Situação da alteração</h1>
    <?php
      $id = $_POST['id'];           
      $nome = strtoupper($_POST['nome']);
      $endereco = strtoupper($_POST['txtEndereco']);
      $ddd = $_POST['ddd'];
      $telefone = $_POST['telefone'];
      $ddd2 = $_POST['ddd2'];
      $telefone2 = $_POST['telefone2'];
      $email = $_POST['email'];
      $registro = $_POST['registro'];
      $material = strtoupper($_POST['material']);
      $valor = strtr($_POST['totalValor'], "," , ".");
      $forma_pgto = $_POST['forma_pgto'];
      $vendedor = $_POST['vendedor'];
      $entrega = dtentrada($_POST['entrega']);
      $retirada = dtentrada($_POST['retirada']);
      $obs = strtoupper($_POST['obs']);
      $situacao = $_POST['situacao'];
      $status = $_POST['status'];
      //$emissao = date("Y-m-d H:i:s");
      $insert = "UPDATE locacao SET nome = '".$nome."', registro = '".$registro."', ddd = '".$ddd."', telefone = '".$telefone."', ddd2 = '".$ddd2."', telefone2 = '".$telefone2."', email = '".$email."', endereco = '".$endereco."', material = '".$material."', valor = '".$valor."', forma_pgto = '".$forma_pgto."', vendedor = '".$vendedor."', entrega = '".$entrega."', retirada = '".$retirada."', obs = '".$obs."', situacao = '".$situacao."', status = '".$status."' WHERE id = ".$id;
      $conecta = mysqli_query($connection, $insert);
      if($conecta){
      ?>  
      <a href="index.php" class="waves-effect waves-light btn-large"><i class="material-icons right">send</i>Alteração realizada com sucesso! Clique para continuar</a>
      <?php
      }else{
      ?>  
      <a href="cadastra-cliente.php" class="waves-effect waves-light btn-large"><i class="material-icons right">send</i>Alteração não realizado! Clique para retornar</a>
      <?php  
      }
    }else{
        $id = $_GET['id'];
        $select = "SELECT * FROM locacao WHERE id = ".$id;
        $conecta = mysqli_query($connection, $select);
        if(mysqli_num_rows($conecta)>0){
            while($row = mysqli_fetch_assoc($conecta)) {
        ?>
        <form id="myForm" class="col s12" action="confirma-edicao-cliente.php" method="post">
            <h3 class="flow-text">Lista de Produto</h3>
            <div class="section">
                <ul id="tabs-swipe-demo" class="tabs">
                    <li class="tab col s6"><a href="#test-swipe-1">Pacotes Promocionais</a></li>
                    <li class="tab col s6"><a href="#test-swipe-2">Equipementos Avulsos</a></li>
                </ul>
                <div id="test-swipe-1" class="col s12">
                    <div class="section">
                        <div class="row">
                            <div class="col s4">
                                <a class="waves-effect waves-light btn" href="#modal1">Andaimes 1.00x1.00</a>
                            </div>
                            <div class="col s4">
                                <a class="waves-effect waves-light btn" href="#modal2">Andaimes 1.50x1.50</a>
                            </div>
                            <div class="col s4">
                                <a class="waves-effect waves-light btn" href="#modal3">Andaimes 1.50x1.00</a>
                            </div>
                        </div>             
                        <div class="row">
                            <div class="col s4">
                                <a class="waves-effect waves-light btn" href="#modal4">Escoras Metálicas</a>        
                            </div>
                            <div class="col s4">
                                <a class="waves-effect waves-light btn" href="#modal5">Escadas Extensíveis</a>
                            </div>
                            <div class="col s4">
                                <a class="waves-effect waves-light btn" href="#modal6">Cadeirinhas Suspensas</a>
                            </div>
                        </div>
                    </div>                      
                </div>
                <div id="test-swipe-2" class="col s12">
                    <div class="section">
                        <div class="row">
                            <div class="col s4">
                                <a class="dropdown-trigger btn" href="#" data-activates="dropdown">Andaimes 
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                                <ul id="dropdown" class="dropdown-content">
                                    <li class="divider" tabindex="-1"></li>
                                    <li><a href="#modal7">Andaimes avulsos 1.00x1.00</a></li>
                                    <li><a href="#modal8">Andaimes avulsos 1.50x1.00</a></li>
                                    <li><a href="#modal9">Andaimes avulsos 1.50x1.50</a></li>
                                </ul>
                            </div>
                            <div class="col s4">
                                <a class="dropdown-trigger btn" href="#" data-activates="dropdown1">Plataformas Metálicas
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                                <ul id="dropdown1" class="dropdown-content">
                                    <li class="divider" tabindex="-1"></li>
                                    <li><a href="#modal10">Plataformas Metálicas 1.00x1.00</a></li>
                                    <li><a href="#modal11">Plataformas Metálicas 1.50x1.00</a></li>
                                    <li><a href="#modal12">Plataformas Metálicas 1.50x1.50</a></li>
                                </ul>
                            </div>
                            <div class="col s4">
                                <a class="dropdown-trigger btn" href="#" data-activates="dropdown2">Sapatas Ajustáveis
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                                <ul id="dropdown2" class="dropdown-content">
                                    <li class="divider" tabindex="-1"></li>
                                    <li><a href="#modal13">Sapatas Ajustáveis (P)</a></li>
                                    <li><a href="#modal14">Sapatas Ajustáveis (G)</a></li>
                                </ul>
                            </div>        
                        </div>
                        <div class="row">
                            <div class="col s4">
                                <a class="dropdown-trigger btn" href="#" data-activates="dropdown3">Rodinhas com Travas
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                                <ul id="dropdown3" class="dropdown-content">
                                    <li class="divider" tabindex="-1"></li>
                                    <li><a href="#modal15">Rodinhas com Travas (P)</a></li>
                                    <li><a href="#modal16">Rodinhas com Travas (G)</a></li>
                                </ul>
                            </div>
                            <div class="col s4">
                                <a class="dropdown-trigger btn" href="#" data-activates="dropdown4">Travessas
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                                <ul id="dropdown4" class="dropdown-content">
                                    <li class="divider" tabindex="-1"></li>
                                    <li><a href="#modal17">Travessas 1.00x1.00</a></li>
                                    <li><a href="#modal18">Travessas 1.50x1.00</a></li>
                                    <li><a href="#modal19">Tesouras 1.50x1.50</a></li>
                                </ul>
                            </div>
                            <div class="col s4">
                                <a class="dropdown-trigger btn" href="#" data-activates="dropdown5">Diagonais
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                                <ul id="dropdown5" class="dropdown-content">
                                    <li class="divider" tabindex="-1"></li>
                                    <li><a href="#modal20">Diagonais 1.00x1.00</a></li>
                                    <li><a href="#modal21">Diagonais 1.50x1.00</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s4">
                                <a class="waves-effect waves-light btn" href="#modal22">Cinto de Segurança</a>
                            </div>
                            <div class="col s4">
                                <a class="waves-effect waves-light btn" href="#modal23">Cordas</a>
                            </div>
                        </div>    
                    </div>               
                </div>
            </div>     
            <!-- Modal 1 Structure -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                <h4>Andaimes 1.00x1.00</h4>
                <p>
                    <div class="input-field col s3 m3 l3">
                                <select name="torre" id="quantidade" class="icons">
                                    <option value="" selected>Quantidade de torres</option>
                                    <?php
                                        for($i=1; $i<=10; $i++){
                                    ?>
                                        <option value="<?=$i?>"><?=$i?> Torre(s)</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="input-field col s9 m9 l9">
                                <select name="andaime" id="andaimex" class="icons">                          
                                    <option value="" selected>Quantidade de Andaimes</option>        
                                </select>
                            </div>
                            <div class="input-field col s9 m9 l9">     
                                <p>
                                    <input name="group1" type="radio" id="test1" />
                                    <label for="test1"><span id="rodinhasx">Rodinhas com travas (P)</span></label>
                                    <input name="group1" type="radio" id="test2" />
                                    <label for="test2"><span id="sapatasx">Sapatas ajustáveis (P)</span></label>
                                </p>
                            </div>    
                            <div class="input-field col s3 m3 l3">
                                <a id="add100x100" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                            </div>
                </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 1 Structure -->
            <!-- Modal 2 Structure -->
            <div id="modal2" class="modal">
                <div class="modal-content">
                <h4>Andaimes 1.50x1.50</h4>
                <p>
                    <div class="input-field col s3 m3 l3">
                        <select name="torre" id="quantidade2" class="icons">
                            <option value="" selected>Quantidade de torres</option>
                            <?php
                                for($i=1; $i<=10; $i++){
                            ?>
                                <option value="<?=$i?>"><?=$i?> Torre(s)</option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="input-field col s9 m9 l9">
                        <select name="andaime" id="andaimex2" class="icons">                          
                            <option value="" selected>Quantidade de Andaimes</option>        
                        </select>
                    </div>
                    <div class="input-field col s9 m9 l9">    
                        <p>
                            <input name="group2" type="radio" id="test3" />
                            <label for="test3"><span id="rodinhasx2">Rodinhas com travas (G)</span></label>
                            <input name="group2" type="radio" id="test4" />
                            <label for="test4"><span id="sapatasx2">Sapatas ajustáveis (G)</span></label>
                        </p>
                    </div>
                    <div class="input-field col s3 m3 l3">
                        <a id="add150x150" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                    </div>
                </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 2 Structure -->
            <!-- Modal 3 Structure -->
            <div id="modal3" class="modal">
                <div class="modal-content">
                <h4>Andaimes 1.50x1.00</h4>
                <p>
                    <div class="input-field col s3 m3 l3">
                        <select name="torre" id="quantidade3" class="icons">
                            <option value="" selected>Quantidade de torres</option>
                            <?php
                                for($i=1; $i<=10; $i++){
                            ?>
                                <option value="<?=$i?>"><?=$i?> Torre(s)</option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="input-field col s9 m9 l9">
                        <select name="andaime" id="andaimex3" class="icons">                          
                            <option value="" selected>Quantidade de Andaimes</option>        
                        </select>
                    </div>
                    <div class="input-field col s9 m9 l9">    
                        <p>
                            <input name="group3" type="radio" id="test5" />
                            <label for="test5"><span id="rodinhasx3">Rodinhas com travas (G)</span></label>
                            <input name="group3" type="radio" id="test6" />
                            <label for="test6"><span id="sapatasx3">Sapatas ajustáveis (G)</span></label>
                        </p>
                    </div>
                    <div class="input-field col s3 m3 l3">
                        <a id="add150x100" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 3 Structure -->
            <!-- Modal 4 Structure -->
            <div id="modal4" class="modal">
                <div class="modal-content">
                <h4>Escoras Metálicas</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="escoras" class="icons">
                                <option value="" selected>Selecione a quantidade de Escoras</option>
                                <?php
                                    for($i=1; $i<=36; $i++){
                                    $valorEscora = 12.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Escora(s) Metálicas - R$ <?=($i*$valorEscora)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a id="addescoras" onClick="addProdutos('escoras')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 4 Structure -->
            <!-- Modal 5 Structure -->
            <div id="modal5" class="modal">
                <div class="modal-content">
                <h4>Escadas Extensíveis</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="escadas" class="icons">
                                <option value="" selected>Selecione a quantidade de Escadas</option>
                                <?php
                                    for($i=1; $i<=10; $i++){
                                    $valorEscada = 60.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Escada(s) Extensíveis - R$ <?=($i*$valorEscada)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('escadas')" id="addescadas" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 5 Structure -->
            <!-- Modal 6 Structure -->
            <div id="modal6" class="modal">
                <div class="modal-content">
                <h4>Cadeirinhas Suspensas</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="cadeirinhas" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Cadeirinha(s)</option>
                                <?php
                                    for($i=1; $i<=5; $i++){
                                    $valorCadeirinha = 260.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Cadeirinha Suspensa, <?=$i?> Trava-Quedas, <?=$i?> Cinto de Segurança, <?=$i?> Corda, <?=$i?> Afastador - R$ <?=($i*$valorCadeirinha)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('cadeirinhas')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 6 Structure -->
            <!-- Modal 7 Structure -->
            <div id="modal7" class="modal">
                <div class="modal-content">
                <h4>Andaimes Avulços 1.00x1.00</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="andaimeAvulco100x100" class="icons">
                                <option value="" selected>Selecione a quantidade do(s) Andaime(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $valorAndaimeAvulco100x100 = 10.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Andaimes Tubulares 1.00x1.00 - R$ <?=($i*$valorAndaimeAvulco100x100)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('andaimeAvulco100x100')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 7 Structure -->
            <!-- Modal 8 Structure -->
            <div id="modal8" class="modal">
                <div class="modal-content">
                <h4>Andaimes Avulços 1.50x1.00</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="andaimeAvulco150x100" class="icons">
                                <option value="" selected>Selecione a quantidade do(s) Andaime(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $valorAndaimeAvulco150x100 = 12.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Andaimes Tubulares 1.50x1.00 - R$ <?=($i*$valorAndaimeAvulco150x100)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('andaimeAvulco150x100')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 8 Structure -->
            <!-- Modal 9 Structure -->
            <div id="modal9" class="modal">
                <div class="modal-content">
                <h4>Andaimes Avulços 1.50x1.50</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="andaimeAvulco150x150" class="icons">
                                <option value="" selected>Selecione a quantidade do(s) Andaime(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $valorAndaimeAvulco150x150 = 15.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Andaimes Tubulares 1.50x1.50 - R$ <?=($i*$valorAndaimeAvulco150x150)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('andaimeAvulco150x150')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 9 Structure -->
            <!-- Modal 10 Structure -->
            <div id="modal10" class="modal">
                <div class="modal-content">
                <h4>Plataformas Metálicas 1.00x1.00</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="plataformaMetalica100x100" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Plataforma(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $valorPlataformaMetalica100x100 = 10.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Plataformas Metálicas 1.00 - R$ <?=($i*$valorPlataformaMetalica100x100)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('plataformaMetalica100x100')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 10 Structure -->
            <!-- Modal 11 Structure -->
            <div id="modal11" class="modal">
                <div class="modal-content">
                <h4>Plataformas Metálicas 1.50x1.00</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="plataformaMetalica150x100" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Plataforma(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $valorPlataformaMetalica150x100 = 15.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Plataformas Metálicas 1.42 - R$ <?=($i*$valorPlataformaMetalica150x100)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('plataformaMetalica150x100')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 11 Structure -->
            <!-- Modal 12 Structure -->
            <div id="modal12" class="modal">
                <div class="modal-content">
                <h4>Plataformas Metálicas 1.50x1.50</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="plataformaMetalica150x150" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Plataforma(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $valorPlataformaMetalica150x150 = 15.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Plataformas Metálicas 1.60 - R$ <?=($i*$valorPlataformaMetalica150x150)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('plataformaMetalica150x150')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 12 Structure -->
            <!-- Modal 13 Structure -->
            <div id="modal13" class="modal">
                <div class="modal-content">
                <h4>Sapatas Ajustáveis (P)</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="sapatasAjustaviesP" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Sapata(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $sapatasAjustaviesP = 10.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Sapatas Ajustáveis (P) - R$ <?=($i*$sapatasAjustaviesP)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('sapatasAjustaviesP')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 13 Structure -->
            <!-- Modal 13 Structure -->
            <div id="modal14" class="modal">
                <div class="modal-content">
                <h4>Sapatas Ajustáveis (G)</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="sapatasAjustaviesG" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Sapata(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $sapatasAjustaviesG = 10.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Sapatas Ajustáveis (G) - R$ <?=($i*$sapatasAjustaviesG)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('sapatasAjustaviesG')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 14 Structure -->
            <!-- Modal 15 Structure -->
            <div id="modal15" class="modal">
                <div class="modal-content">
                <h4>Rodinhas com Travas (P)</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="rodinhasP" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Rodinha(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $rodinhasP = 10.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Rodinhas com travas (P) - R$ <?=($i*$rodinhasP)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('rodinhasP')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 15 Structure -->
            <!-- Modal 16 Structure -->
            <div id="modal16" class="modal">
                <div class="modal-content">
                <h4>Rodinhas com Travas (G)</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="rodinhasG" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Rodinha(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $rodinhasG = 10.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Rodinhas com travas (G) - R$ <?=($i*$rodinhasG)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('rodinhasG')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 16 Structure -->
            <!-- Modal 17 Structure -->
            <div id="modal17" class="modal">
                <div class="modal-content">
                <h4>Travessas 1.00x1.00</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="travessas100x100" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Travessa(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $travessas100x100 = 5.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Travessas 1.00 - R$ <?=($i*$travessas100x100)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('travessas100x100')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 17 Structure -->
            <!-- Modal 18 Structure -->
            <div id="modal18" class="modal">
                <div class="modal-content">
                <h4>Travessas 1.50x1.00</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="travessas150x100" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Travessa(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $travessas150x100 = 5.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Travessas 1.60 - R$ <?=($i*$travessas150x100)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('travessas150x100')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 18 Structure -->
            <!-- Modal 19 Structure -->
            <div id="modal19" class="modal">
                <div class="modal-content">
                <h4>Tesouras 1.50x1.50</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="travessas150x150" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Travessa(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $travessas150x150 = 5.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Tesouras 1.50 - R$ <?=($i*$travessas150x150)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('travessas150x150')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 19 Structure -->
            <!-- Modal 20 Structure -->
            <div id="modal20" class="modal">
                <div class="modal-content">
                <h4>Diagonais 1.00x1.00</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="diagonais100x100" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Diagonais </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $diagonais100x100 = 5.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Diagonais 1.40 - R$ <?=($i*$diagonais100x100)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('diagonais100x100')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 20 Structure -->
            <!-- Modal 21 Structure -->
            <div id="modal21" class="modal">
                <div class="modal-content">
                <h4>Diagonais 1.50x1.00</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="diagonais150x100" class="icons">
                                <option value="" selected>Selecione a quantidade da(s) Diagonais </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $diagonais150x100 = 5.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Diagonais 2.15 - R$ <?=($i*$diagonais150x100)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('diagonais150x100')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 21 Structure -->
            <!-- Modal 22 Structure -->
            <div id="modal22" class="modal">
                <div class="modal-content">
                <h4>Cinto de Segurança</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="cintosDeSeguranca" class="icons">
                                <option value="" selected>Selecione a quantidade de Cinto(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $cintosDeSeguranca = 5.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Cinto(s) de Segurança - R$ <?=($i*$cintosDeSeguranca)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('cintosDeSeguranca')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 22 Structure -->
            <!-- Modal 23 Structure -->
            <div id="modal23" class="modal">
                <div class="modal-content">
                <h4>Cordas</h4>
                    <p>
                        <div class="input-field col s9 m9 l9">  
                            <select name="andaime" id="cordas" class="icons">
                                <option value="" selected>Selecione a quantidade de Cordas(s) </option>
                                <?php
                                    for($i=1; $i<=60; $i++){
                                    $cordas = 5.00;
                                ?>
                                    <option value="<?=$i?>"><?=$i?> Corda(s) - R$ <?=($i*$cordas)?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s3 m3 l3">
                            <a onclick="addProdutos('cordas')" class="btn-floating btn-large modal-action modal-close waves-effect waves-light geen"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
            <!--Fim Modal 23 Structure -->
            <h3 class="flow-text">Dados do Carrinho</h3>
            <div class="input-field col s12 m12 l12">
                <i class="material-icons prefix">shopping_cart</i>
                <div id="chipsId" class="chips"></div>
                <input id="icon_email" name="material" type="hidden" class="chips">
            </div>
            <script>
                function carregaDataPicker(){
                   document.getElementById("entrega").value="<?=dtsaida(substr($row['entrega'],0,-8))?>";
                   document.getElementById("retirada").value="<?=dtsaida(substr($row['retirada'],0,-8))?>"; 
                }
            </script>    
            <div class="input-field col s6 m4 l3">
                <i class="material-icons prefix">date_range</i>
                <input id="entrega" name="entrega" value="<?=dtsaida(substr($row['entrega'],0,-8))?>" type="text" class="datepicker">  
            </div>
            <div class="input-field col s6 m4 l3">
                <input id="retirada" name="retirada" value="<?=dtsaida(substr($row['retirada'],0,-8))?>" type="text" class="datepicker">
            </div>
            <div class="input-field col s6 m4 l6">    
                <input style="color: #333" id="diasCorridos" type="text" name="diascorridos" value="<?=datadiff(substr($row['entrega'],0,-8),substr($row['retirada'],0,-8)).' DIAS CORRIDOS'; ?>" readonly />
                <!--<a  class="btn-flat disabled"></a>-->
            </div>
            
            <div class="input-field col s12 m12 l12">
                <i class="material-icons prefix">map</i>         
                <center>
                    <input id="txtEndereco" style="background-color: #fff; padding-left: 15px;" name="txtEndereco" value="<?=$row['endereco']?>" class="controls" type="text" placeholder="Digite o endereço aqui">
                    <div id="type-selector" class="controls">
                      <input type="radio" name="type" id="changetype-all" checked="checked">
                      <label for="txtEndereco">Endereço</label>
                    </div>
                    <div id="map" class="card-panel hoverable" style="width:90%; height:200px"></div>
                </center>
            </div>
            <div class="input-field col s12 m6 l6">
                <i class="material-icons prefix">attach_money</i>
                <input id="valor" placeholder="Sub-total" style="color: #333" name="valor" value="<?=moedaReal($row['valor'])?>" type="text" class="validate" readonly>
                <label for="valor">Sub-total</label>
            </div>
            <div class="input-field col s12 m6 l6">
                <i class="material-icons prefix">local_shipping</i>
                <?php
                    if(isset($row['frete'])){
                        $varFrete = moedaReal($row['frete']);
                    }else{
                        $varFrete = '0,00';
                    }    
                ?>
                <input id="frete" placeholder="Valor Frete" style="color: #333" name="frete" 
                value="<?=$varFrete?>" type="text" readonly>
                <label for="frete">Frete</label>
            </div>
            <div class="input-field col s6 m4 l6">
                <i class="material-icons prefix">monetization_on</i>
                <input id="totalValor" placeholder="Valor Total" name="totalValor" value="<?=moedaReal($row['valor'])?>"type="text" class="validate">
                <label for="totalValor">Valor Total</label>
            </div>
            <div class="input-field col s12 m4 l6"> 
                <i class="material-icons prefix">credit_card</i>
                <select name="forma_pgto" class="icons">
                    <option value="" disabled>Escolha o método de pagamento</option>
                    <option value="1" <?php if($row['forma_pgto']=="1"){ echo "selected";}else{ echo "";} ?> >Dinheiro</option>
                    <option value="2" <?php if($row['forma_pgto']=="2"){ echo "selected";}else{ echo "";} ?> >Cartão de Crédito</option>
                    <option value="3" <?php if($row['forma_pgto']=="3"){ echo "selected";}else{ echo "";} ?> >Depósito Bancário</option>
                </select>
                <label>Método de pagamento</label>            
            </div>  
            
            <div class="col s12 m12 l12">            
                <h3 class="flow-text">Dados do Cliente</h3>
            </div>
            <div class="input-field col s12 m12 l12">
                <i class="material-icons prefix">account_circle</i>
                <input placeholder="Nome Completo" type="text"  name="nome" id="nome" value="<?=$row['nome']?>" class="autocomplete">
                <label for="nome">Nome Completo</label>
            </div>    
            <div class="input-field col s12 m16 l6">
                <i class="material-icons prefix">fingerprint</i>
                <input name="registro" id="registro" value="<?=$row['registro']?>" type="text" class="validate" onblur="trueCNPJ(this.value)">
                <label for="registro">Registro</label>
            </div>
            <div class="input-field col s12 m6 l6">
                <i class="material-icons prefix">contact_mail</i>
                <input name="email" id="email" type="email" value="<?=$row['email']?>" class="validate">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s4 m2 l2">
                <i class="material-icons prefix">phone</i>
                <input name="ddd" id="ddd" type="tel" value="<?=$row['ddd']?>" class="validate">
                <label for="ddd">DDD 1</label>
            </div>
            <div class="input-field col s8 m4 l4">
                <input name="telefone" id="telefone" type="tel" value="<?=$row['telefone']?>" class="validate">
                <label for="telefone">Telefone 1</label>
            </div>
            <div class="input-field col s4 m2 l2">
                <i class="material-icons prefix">phone</i>
                <input name="ddd2" id="ddd2" type="tel" value="<?=$row['ddd2']?>" class="validate">
                <label for="ddd2">DDD 2</label>
            </div>
            <div class="input-field col s8 m4 l4">
                <input name="telefone2" id="telefone2" type="tel" value="<?=$row['telefone2']?>" class="validate">
                <label for="telefone2">Telefone 2</label>
            </div>
            <div class="col s12 m12 l12">
                <h3 class="flow-text">Dados da Entrega</h3>
            </div>    
            <!-- 
            <div class="input-field col s12 m12 l12">
                <i class="material-icons prefix">room</i>
                <input id="txtEndereco" name="txtEndereco" class="validate">
            </div>
            -->                       
            <div class="input-field col s12 m12 l12">
                <!--<i class="material-icons prefix">local_shipping</i>-->
                <input id="material" name="material" type="hidden" value="<?=$row['material']?>" class="validate">
                <!--<label for="material">Material</label>-->
            </div>
            <div class="input-field col s12 m12 l12">
                <i class="material-icons prefix">insert_comment</i>
                <input id="icon_email" name="obs" value="<?=$row['obs']?>" type="text" class="validate">
                <label for="icon_email">Observação</label>
            </div>
            <div class="input-field col s12 m6 l6"> 
                <i class="material-icons prefix">person</i>
                <select name="vendedor" class="icons">
                    <option value="" disabled>Escolha o vendedor</option>
                    <option value="1" <?php if($row['vendedor']=="1"){ echo "selected";}else{ echo "";} ?> data-icon="https://scontent.fgig4-1.fna.fbcdn.net/v/t1.0-9/15672988_1397210570311300_7817001615576703992_n.jpg?oh=bf809e999130628e1d495e145b3bbc45&oe=598877D7" class="left circle">Clayton Soares</option>
                    <option value="2" <?php if($row['vendedor']=="2"){ echo "selected";}else{ echo "";} ?> data-icon="https://scontent.fgig4-1.fna.fbcdn.net/v/t1.0-9/15109526_202015303588681_5649696194015475996_n.jpg?oh=4fd343c591a77cdf5177505bd5399dbd&oe=5999AED1" class="left circle">Sandra Lessa</option>
                    <option value="3" <?php if($row['vendedor']=="3"){ echo "selected";}else{ echo "";} ?> data-icon="https://scontent.fgig4-1.fna.fbcdn.net/v/t1.0-9/14330138_132227710567441_3524928093993711998_n.jpg?oh=692cf629529852f457a5bcb198e615cf&oe=594DDA5B" class="left circle">Antônio Sergio</option>
                    <option value="4" <?php if($row['vendedor']=="4"){ echo "selected";}else{ echo "";} ?> data-icon="https://scontent.fgig4-1.fna.fbcdn.net/v/t1.0-9/13631501_1051127964922772_8060052909830460409_n.jpg?oh=e2d01b5e4a399e57a80670143b1fa49a&oe=5997B2E5" class="left circle">Vinícius Soares</option>
                </select>
                <label>Vendedor</label>            
            </div>    
            <div class="input-field col s12 m6 l6"> 
                <i class="material-icons prefix">thumbs_up_down</i>
                <select name="situacao" class="icons">
                    <option value="">Escolha o Situação</option>
                    <option value="1" <?php if($row['situacao']=="1"){ echo "selected";}else{ echo "";} ?> >Á PAGAR</option>
                    <option value="2" <?php if($row['situacao']=="2"){ echo "selected";}else{ echo "";} ?> >PAGO</option>
                    <option value="3" <?php if($row['situacao']=="3"){ echo "selected";}else{ echo "";} ?> >PAGO PARCIALMENTE</option>
                    <option value="4" <?php if($row['situacao']=="4"){ echo "selected";}else{ echo "";} ?> >CANCELADO</option>
                     <option value="5" <?php if($row['situacao']=="5"){ echo "selected";}else{ echo "";} ?> >PAGAMENTO NA RETIRADA</option>
                </select>
                <label>Situação do Pagamento</label>            
            </div>
            <div class="input-field col s12 m6 l6"> 
                <i class="material-icons prefix">thumbs_up_down</i>
                <select name="status" class="icons">
                    <option value="">Defina o Status do Pedido</option>
                    <option value="0" <?php if($row['status']=="0"){ echo "selected";}else{ echo "";} ?> >ENTREGA AGENDADA
                    </option>
                    <option value="1" <?php if($row['status']=="1"){ echo "selected";}else{ echo "";} ?> >SAIU PARA ENTREGA
                    </option>
                    <option value="2" <?php if($row['status']=="2"){ echo "selected";}else{ echo "";} ?> >ENTREGA EM ANDAMENTO
                    </option>
                    <option value="3" <?php if($row['status']=="3"){ echo "selected";}else{ echo "";} ?> >ENTREGA EFETUADA
                    </option>
                    <option value="4" <?php if($row['status']=="4"){ echo "selected";}else{ echo "";} ?> >PEDIDO CANCELADO
                    </option>
                    <option value="5" <?php if($row['status']=="5"){ echo "selected";}else{ echo "";} ?> >ENTREGA NÃO EFETUADA
                    </option>
                    <option value="6" <?php if($row['status']=="6"){ echo "selected";}else{ echo "";} ?> >RETIRADA AGENDADA
                    </option>
                    <option value="7" <?php if($row['status']=="7"){ echo "selected";}else{ echo "";} ?> >SAIU PARA RETIRADA
                    </option>
                    <option value="8" <?php if($row['status']=="8"){ echo "selected";}else{ echo "";} ?> >RETIRADA EM ANDAMENTO
                    </option>
                    <option value="9" <?php if($row['status']=="9"){ echo "selected";}else{ echo "";} ?> >MATERIAL RECOLHIDO
                    </option>
                    <option value="10" <?php if($row['status']=="10"){ echo "selected";}else{ echo "";} ?> >RETIRADA CANCELADA
                    </option>
                    <option value="11" <?php if($row['status']=="11"){ echo "selected";}else{ echo "";} ?> >RETIRADA NÃO EFETUADA
                    </option>
                    <option value="12" <?php if($row['status']=="12"){ echo "selected";}else{ echo "";} ?> >PEDIDO RENOVADO
                    </option>
                </select>
                <label>Situação do Pedido</label>            
            </div>
            <div class="card-action right-align col s12 m12 l12">
                <input name="envio" type="hidden" value="ok" />
                <input name="id" type="hidden" value="<?=$row['id']?>" />
                <a href="javascript:history.back()" class="waves-effect waves-light btn">Voltar <i class="material-icons left">reply</i></a>
                <button class="btn waves-effect waves-light" type="submit" id="btnEnviar" name="action">Confirmar Edição
                <i class="material-icons right">send</i>
                </button>
            </div>             
        </form>
        <?php
                }
            }
        }
        ?>
    <!-- Page Content goes here -->
    </div>          
    <!--Import jQuery before materialize.js-->
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script src="https://icefox0801.github.io/materialize-autocomplete/jquery.materialize-autocomplete.js"></script>

    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -22.9068467, lng: -43.1728965},
          zoom: 13
        });
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        /*var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        center: {lat: 41.85, lng: -87.65}
        });
        directionsDisplay.setMap(map);
        */
        document.getElementById('txtEndereco').addEventListener('change', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('txtEndereco'));

        var types = document.getElementById('type-selector');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            calculateAndDisplayRoute(directionsService, directionsDisplay);
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
          var waypts = [];
          //var checkboxArray = ['Rua Limites, 1896 - Realengo, Rio de Janeiro - RJ, Brasil'];
              waypts.push({
                location: document.getElementById('txtEndereco').value,
                stopover: true
              });
          directionsService.route({
            origin: "Rua Feira Nova, 8 - Realengo, Rio de Janeiro - RJ, Brasil",
            destination: "Rua Feira Nova, 8 - Realengo, Rio de Janeiro - RJ, Brasil",
            waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: 'DRIVING'
          }, function(response, status) {
            if (status === 'OK') {
              directionsDisplay.setDirections(response);
              var route = response.routes[0];
              var distanciaTotal = 0;
              //var summaryPanel = document.getElementById('directions-panel');
              //summaryPanel.innerHTML = '';
              // For each route, display summary information.
              for (var i = 0; i < route.legs.length; i++) {
                var routeSegment = i + 1;
                //window.alert(route.legs[i].start_address);
                var str = route.legs[i].distance.text;
                distanciaTotal += parseFloat(str.replace(",","."));
              }
              var km = 8;
              var gasolina = 4.79;
              var calculo = parseFloat(distanciaTotal) / parseFloat(km);
              var custo = parseFloat(calculo) * parseFloat(gasolina); 
              //alert(custo.toFixed(2).replace(".",","));
              var strTotal = distanciaTotal.toFixed(2); 
              var res = strTotal.replace(".", ",");
              //alert(custo.toFixed(2).replace(".",","));
              var custoTotal = custo.toFixed(2).replace(".",",");
              //return custoTotal;
              var campoValor = document.getElementById('valor').value;
              var somaValorFrete = parseFloat(custo) + parseFloat(campoValor);
              //document.getElementById('valor').value = somaValorFrete.toFixed(2).replace(".",",");
              document.getElementById('frete').value = custoTotal;
              atualizaFreteValor();
              //document.getElementById('totalValor').innerHTML = "Valor Total<br />R$"+somaValorFrete.toFixed(2).replace(".",",");
              //alert(custoTotal+" + "+campoValor+" = "+somaValorFrete.toFixed(2).replace(".",","));
            } else {
              window.alert('Directions request failed due to ' + status);
            }
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqFwLVH-zGYDOflRZ06Z2Yyo4oG3OWvuM&libraries=places&callback=initMap" async defer>
    </script>

    <script>
        $(document).ready(function() {
            $("body").show();
            $( "#quantidade" ).change(function() { 
                var quantidade = $("#quantidade option:selected").val();
                var txtMat = $("#quantidade option:selected").text();
                $("#rodinhasx").text("");
                $("#sapatasx").text("");     
                $.ajax({ 
                    type: 'POST', 
                    url: 'ajax-teste.php', 
                    data: { tabela: 'andaime1x1', quantidade: $( "#quantidade option:selected" ).val() }, 
                    dataType: 'json',
                    success: function (data) { 
                        $("#andaimex option").remove();
                        $.each(data, function(index, element) {   
                            $("#andaimex").append("<option>"+quantidade+" Torre(s) de "+element.metros+" Metros, "+element.andaimes+" Andaimes Tubulares 1.00x1.00, "+element.plataformas+" Plataformas Metálicas 1.00, "+element.travessas+" Travessas 1.00, "+element.diagonais+" Diagonais 1.40, "+element.valor+"</option>");
                            $("#rodinhasx").text(element.rodinhas+" Rodinhas com travas (P)");
                            $("#sapatasx").text(element.sapatas+" Sapatas Ajustáveis (P)");
                            $('#test1').val(element.rodinhas+" Rodinhas com travas (P)");
                            $('#test2').val(element.sapatas+" Sapatas Ajustáveis (P)");
                        });
                        $('#andaimex').material_select();
                    }
                });
            });
            $( "#quantidade2" ).change(function() { 
                var quantidade = $("#quantidade2 option:selected").val();
                var txtMat = $("#quantidade2 option:selected").text();
                $("#rodinhasx2").text("");
                $("#sapatasx2").text("");
                //alert(txtMat);     
                $.ajax({ 
                    type: 'POST', 
                    url: 'ajax-teste.php', 
                    data: { tabela: 'andaimes150x150', quantidade: $( "#quantidade2 option:selected" ).val() }, 
                    dataType: 'json',
                    success: function (data) { 
                        $("#andaimex2 option").remove();
                        $.each(data, function(index, element) {   
                            $("#andaimex2").append("<option>"+quantidade+" Torre(s) de "+element.metros+" Metros, "+element.andaimes+" Andaimes Tubulares 1.50x1.50, "+element.tesouras+" Tesouras 1.50, "+element.plataformas+" Plataformas Metálicas 1.60, "+element.valor+"</option>");
                            $("#rodinhasx2").text(element.rodinhas+" Rodinhas com travas (G)");
                            $("#sapatasx2").text(element.sapatas+" Sapatas Ajustáveis (G)");
                            $('#test3').val(element.rodinhas+" Rodinhas com travas (G)");
                            $('#test4').val(element.sapatas+" Sapatas Ajustáveis (G)");
                        });
                        $('#andaimex2').material_select();
                    }
                });
            });
            $( "#quantidade3" ).change(function() { 
                var quantidade = $("#quantidade3 option:selected").val();
                var txtMat = $("#quantidade3 option:selected").text();
                $("#rodinhasx3").text("");
                $("#sapatasx3").text("");
                //alert(txtMat);     
                $.ajax({ 
                    type: 'POST', 
                    url: 'ajax-teste.php', 
                    data: { tabela: 'andaimes150x100', quantidade: $( "#quantidade3 option:selected" ).val() }, 
                    dataType: 'json',
                    success: function (data) { 
                        $("#andaimex3 option").remove();
                        $.each(data, function(index, element) {
                        console.log(element.valor);   
                            $("#andaimex3").append("<option>"+quantidade+" Torre(s) de "+element.metros+" Metros, "+element.andaimes+" Andaimes Tubulares 1.50x1.00, 4 Travessas 1.60, "+element.plataformas+" Plataformas Metálicas 1.42, "+element.valor+"</option>");
                            $("#rodinhasx3").text(element.rodinhas+" Rodinhas com travas (G)");
                            $("#sapatasx3").text(element.sapatas+" Sapatas Ajustáveis (G)");
                            $('#test5').val(element.rodinhas+" Rodinhas com travas (G)");
                            $('#test6').val(element.sapatas+" Sapatas Ajustáveis (G)");
                        });
                        $('#andaimex3').material_select();
                    }
                });
            });
            var x = 1;
            $("#add100x100").on("click",function(e){
                var textox = $("#andaimex option:selected").text().split(",");
                //var textox = $("#andaimex option:selected").text();
                var arraytexto = $(textox).get(-1);
                textox.splice(textox.indexOf(arraytexto), 1);
                var valorAtual = $('#valor').val();
                if(valorAtual==""){
                    valorAtual = 0;
                }    
                $('#valor').val(parseInt(arraytexto) + parseInt(valorAtual));
                //textox.splice( $.inArray($(textox).get(-1), textox), 1);
                //alert(textox);
                var texto = textox+", "+$('input[name=group1]:checked', '#myForm').val()+ " - R$"+arraytexto;
                x++;
                var e = jQuery.Event("keydown");
                e.which = 13; // # Some key code value
                $(".chips input").val(texto);
                $(".chips input").trigger(e);
                var data = Array();
                data = $('#chipsId').material_chip('data');
                $("#jorgao").text("");
                //var array = array();
                for(var i=0; i<data.length; i++) {
                    var o = i + 1;
                    $("#jorgao").append("<p>:"+data[i].tag+"</p>");
                    var $toastContent = $("<span>"+data[i].tag+"</span>");
                    Materialize.toast($toastContent, 5000);
                }
                $("#material").val($("#jorgao").text());
            });
            $("#add150x150").on("click",function(e){
                var textox = $("#andaimex2 option:selected").text().split(",");
                var arraytexto = $(textox).get(-1);
                //$('#valor').val(arraytexto);
                textox.splice( $.inArray($(textox).get(-1), textox), 1);
                var valorAtual = $('#valor').val();
                if(valorAtual==""){
                    valorAtual = 0;
                }    
                $('#valor').val(parseInt(arraytexto) + parseInt(valorAtual));
                
                var texto = textox+", "+$('input[name=group2]:checked', '#myForm').val()+ " - R$"+arraytexto;
                x++;
                var e = jQuery.Event("keydown");
                e.which = 13; // # Some key code value
                $(".chips input").val(texto);
                $(".chips input").trigger(e);
                var data = Array();
                data = $('#chipsId').material_chip('data');
                $("#jorgao").text("");
                for(var i=0; i<data.length; i++) {
                    var o = i + 1;
                    $("#jorgao").append("<p>:"+data[i].tag+"</p>");
                    var $toastContent = $("<span>"+data[i].tag+"</span>");
                    Materialize.toast($toastContent, 5000);
                }
                $("#material").val($("#jorgao").text());
            });
            $("#add150x100").on("click",function(e){
                var textox = $("#andaimex3 option:selected").text().split(",");
                var arraytexto = $(textox).get(-1);
                var valorAtual = $('#valor').val();
                if(valorAtual==""){
                    valorAtual = 0;
                }    
                $('#valor').val(parseInt(arraytexto) + parseInt(valorAtual));
                //$('#valor').val(arraytexto);
                textox.splice( $.inArray($(textox).get(-1), textox), 1);
                
                var texto = textox+", "+$('input[name=group3]:checked', '#myForm').val()+ " - R$"+arraytexto;
                x++;
                var e = jQuery.Event("keydown");
                e.which = 13; // # Some key code value
                $(".chips input").val(texto);
                $(".chips input").trigger(e);
                var data = Array();
                data = $('#chipsId').material_chip('data');
                $("#jorgao").text("");
                for(var i=0; i<data.length; i++) {
                    var o = i + 1;
                    $("#jorgao").append("<p>:"+data[i].tag+"</p>");
                    var $toastContent = $("<span>"+data[i].tag+"</span>");
                    Materialize.toast($toastContent, 5000);
                }
                $("#material").val($("#jorgao").text());
            });
                        
            $("#btnEnviar").mouseenter(function() {
                var data = Array();
                data = $('#chipsId').material_chip('data');
                $("#jorgao").text("");
                for(var i=0; i<data.length; i++) {
                    var o = i + 1;
                    $("#jorgao").append("<p>:"+data[i].tag+"</p>");
                }
                //$("#material").val("");
                $("#material").text($("#jorgao").text());
                $("#material").val($("#jorgao").text());
            });
            $('.modal').modal();            
            $('.chips').material_chip();
            $('.dropdown-trigger').dropdown({hover: true});
            var dataChip = Array();

            $('.chips').on('chip.add', function(e, chip) {
                var valorChip = 0;
                dataChip = $('#chipsId').material_chip('data');
                $('#valor').val("");
                $('#valor').text("");
                for(var i=0; i<dataChip.length; i++) {
                    var o = i + 1; 
                    var textox = dataChip[i].tag.split("R$");
                    var arraytexto = $(textox).get(-1);
                    valorChip += parseInt(arraytexto);                  
                    //alert("Valor Total: R$"+valorChip+" | Valor Atual: R$"+arraytexto);        
                }  
                //$('#valor').val(valorChip);
                var entregaChip = $( "#entrega" ).val();
                var retiradaChip = $( "#retirada" ).val();
                if(entregaChip=="" || retiradaChip==""){
                    $("#valor").val(valorChip+",00");
                    atualizaFreteValor();                       
                }else{                           
                    $.ajax({ 
                        type: 'POST', 
                        url: 'ajax-teste-data.php', 
                        data: { entrega: $( "#entrega" ).val(), retirada: $( "#retirada" ).val(), valor: valorChip}, 
                        dataType: 'json',
                        success: function(data){ 
                            $("#valor").val(data.valor+",00");
                            $("#diasCorridos").val(data.dias+" Dias Corridos");
                            atualizaFreteValor(); 
                        }   
                    });
                }
            });

            $('.chips').on('chip.delete', function(e, chip) {
                var valorChip = 0;
                dataChip = $('#chipsId').material_chip('data');
                $('#valor').val("");
                $('#valor').text("");
                for(var i=0; i<dataChip.length; i++) {
                    var o = i + 1; 
                    var textox = dataChip[i].tag.split("R$");
                    var arraytexto = $(textox).get(-1);
                    valorChip += parseInt(arraytexto);                  
                    //alert("Valor Total: R$"+valorChip+" | Valor Atual: R$"+arraytexto);        
                }  
                //$('#valor').val(valorChip);
                var entregaChip = $( "#entrega" ).val();
                var retiradaChip = $( "#retirada" ).val();
                if(entregaChip=="" || retiradaChip==""){
                    $("#valor").val(valorChip+",00");
                    atualizaFreteValor();                       
                }else{                           
                    $.ajax({ 
                        type: 'POST', 
                        url: 'ajax-teste-data.php', 
                        data: { entrega: $( "#entrega" ).val(), retirada: $( "#retirada" ).val(), valor: valorChip}, 
                        dataType: 'json',
                        success: function(data){ 
                            $("#valor").val(data.valor+",00");
                            $("#diasCorridos").val(data.dias+" Dias Corridos");
                            atualizaFreteValor(); 
                        }   
                    });
                }
            });
            <?php
                if(isset($_GET['id'])){
            ?>        
                var tagsMeta = [];
                //alert(tagsMeta);
                var tagsString = $("#material").val();
                //alert(tagsString);
                var tagsArray = tagsString.split(':');
                for(i=1; i < tagsArray.length; i++) {
                    tagsMeta.push({tag: tagsArray[i]});
                    console.log(tagsMeta);
                }
                $('.chips').material_chip({
                    data: tagsMeta
                });
            <?php
                }    
            ?>
            $('.dropdown-button').dropdown({
                inDuration: 300,
                outDuration: 225,
                constrainWidth: false, // Does not change width of dropdown to that of the activator
                hover: true, // Activate on hover
                gutter: 0, // Spacing from edge
                belowOrigin: false, // Displays dropdown below the button
                alignment: 'left', // Displays dropdown with edge aligned to the left of button
                stopPropagation: false // Stops event propagation
            });
            $('.dropdown-trigger').dropdown({hover:true});           
            $('select').material_select();
            $('.tabs').tabs();
            $(".button-collapse").sideNav(); 
            $('.datepicker').pickadate({
                monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
                weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
                today: 'Hoje',
                clear: 'Limpar',
                close: 'Pronto',
                labelMonthNext: 'Próximo mês',
                labelMonthPrev: 'Mês anterior',
                labelMonthSelect: 'Selecione um mês',
                labelYearSelect: 'Selecione um ano',
                selectMonths: true, 
                selectYears: 15
            });

            var dataChips = Array();
            $( "#retirada" ).change(function() { 
                //var txtMat = $("#quantidade option:selected").text();
                //var textox = $("#andaimex option:selected").text().split(",");
                //var textox2 = $("#andaimex2 option:selected").text().split(",");
                //var textox3 = $("#andaimex3 option:selected").text().split(",");
                //var textox2 = 10;
                //var textox3 = 10;
                //var arraytexto = parseInt($(textox).get(-1)) + parseInt($(textox2).get(-1)) + parseInt($(textox3).get(-1));
                var valorChip = 0;
                dataChips = $('#chipsId').material_chip('data');
                $('#valor').val("");
                $('#valor').text("");
                for(var i=0; i<dataChips.length; i++) {
                    var o = i + 1; 
                    var textox = dataChips[i].tag.split("R$");
                    var arraytexto = $(textox).get(-1);
                    valorChip += parseInt(arraytexto);                  
                    //alert("Valor Total: R$"+valorChip+" | Valor Atual: R$"+arraytexto);        
                }  
                //$('#valor').val(valorChip);
                var entregaChip = $( "#entrega" ).val();
                var retiradaChip = $( "#retirada" ).val();
                if(entregaChip=="" || retiradaChip==""){
                    $("#valor").val(valorChip+",00");
                    atualizaFreteValor();                       
                }else{                           
                    $.ajax({ 
                        type: 'POST', 
                        url: 'ajax-teste-data.php', 
                        data: { entrega: $( "#entrega" ).val(), retirada: $( "#retirada" ).val(), valor: valorChip}, 
                        dataType: 'json',
                        success: function(data){ 
                            $("#valor").val(data.valor+",00");
                            $("#diasCorridos").val(data.dias+" Dias Corridos");
                            atualizaFreteValor();
                        }   
                    });
                }
            });
            var dataCliente = {};
            $.ajax({
              dataType: 'json',
              url: 'ajax-teste-cliente.php',
              success: function(response) {
                var nomeArray = response;
                for (var i = 0; i < nomeArray.length; i++) {
                  //console.log(countryArray[i].name);
                  dataCliente[nomeArray[i].nome] = null; //countryArray[i].flag or null
                }
                $('input.autocomplete').autocomplete({
                  data: dataCliente,
                  limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
                }).on('change', function name(argumento) {
                  $.ajax({
                    dataType: "json",
                    data: {cliente: this.value},
                    method: "POST", 
                    url: 'ajax-teste-cliente-unico.php',
                    success: function(response2) {
                        $("#registro").val(response2[0].registro);
                        $("#registro").text(response2[0].registro);
                        $("#email").val(response2[0].email);
                        $("#email").text(response2[0].email);
                        $("#ddd").val(response2[0].ddd);
                        $("#ddd").text(response2[0].ddd);
                        $("#ddd2").val(response2[0].ddd2);
                        $("#ddd2").text(response2[0].ddd2);
                        $("#telefone").val(response2[0].telefone);
                        $("#telefone").text(response2[0].telefone);
                        $("#telefone2").val(response2[0].telefone2);    
                        $("#telefone2").text(response2[0].telefone2);    
                      //console.log(response2+" Sucesso");
                      //console.log(countryArray[i].name);
                        console.log(response2[0].nome+" - "+response2[0].email+" - "+response2[0].registro+" - "+response2[0].ddd+" - "+response2[0].ddd2+" - "+response2[0].telefone+" - "+response2[0].telefone2+" - "+response2[0].endereco); //countryArray[i].flag or null
                      //console.log(this.value);
                    }  
                  });       
                });    
              }
            });
        });     
      </script>
      <script type="text/javascript">
        function atualizaFreteValor(){
            var valorFrete = document.getElementById('frete').value;
            var valorParcial = document.getElementById('valor').value;
            if(valorFrete==""){
               valorFrete = "0,00"; 
            }
            if(valorParcial==""){
               valorParcial = "0,00"; 
            }
            //console.log(valorParcial.replace(",",".")+" - "+valorFrete.replace(",","."));
            var parcialFrete = parseFloat(valorParcial.replace(",",".")) + parseFloat(valorFrete.replace(",","."));

            //alert(valorParcial+" - "+parcialFrete+" - "+parcialFrete.replace(".",","));
            return document.getElementById('totalValor').value = parcialFrete.toFixed(2).replace(".",",");

            //return document.getElementById('totalValor').innerHTML = "Valor Total<br />R$"+parcialFrete.toFixed(2).replace(".",",");
        }
        function addProdutos(obj){
            var produtos = obj; 
            var texto = $("#"+produtos+" option:selected").text();
            //alert(texto);
            //x++;
            var e = jQuery.Event("keydown");
            e.which = 13; // # Some key code value
            $(".chips input").val(texto);
            $(".chips input").trigger(e);
            var data = Array();
            data = $('#chipsId').material_chip('data');
            $("#jorgao").text("");
            for(var i=0; i<data.length; i++) {
                var o = i + 1;
                $("#jorgao").append("<p>:"+data[i].tag+"</p>");
                var $toastContent = $("<span>"+data[i].tag+"</span>");
                Materialize.toast($toastContent, 5000);
            }
            $("#material").val($("#jorgao").text());
        }
        function trueCNPJ(obj){
          if(obj.length>12){  
            $.ajax({
            url: 'https://www.receitaws.com.br/v1/cnpj/'+obj, type: 'GET', crossDomain: true, dataType: 'jsonp', success: function(data) { console.log(data.nome); document.getElementById("nome").value = data.nome; document.getElementById("email").value = data.email; }, error: function(e) { console.error(e); },beforeSend: function(xhr) {
            xhr.setRequestHeader('Access-Control-Allow-origin', 'true');
            }});
          }  
        }
      </script>
    </body>
  </html>