<!DOCTYPE html>
<html> 
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Tinos:700" rel="stylesheet">
       <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="css/materialize.min.css">  
      <!--Let browser know website is optimized for mobile-->
      <script src="https://www.gstatic.com/firebasejs/5.5.5/firebase.js"></script>
      <script src="js/firebase.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style>
        
        html {
          
        }
        body {
          -webkit-print-color-adjust: exact;
        }
        .col{
          border:1px solid #999;          
        }
        p{
          margin:4px 0px;
        }
        table{
          border:1px solid #999;    
        }  
        th{
          margin:0px 0px;
          padding:0px 10px;
          border:0px solid #999;
        }
        td{
          padding:4px 10px;
          border:0px solid #999;
          /*color:#950000;*/
        }
        #printable{
          font-size: 12px;
        }
        #printable .row{
          margin:0px;
        }
        #printable .col{
          margin:0px;
        }
        #conteudo{
          font-family: 'Tinos';
        }
        .side-nav .user-view,.side-nav .userView{position:relative;padding:32px 32px 0;margin-bottom:8px}.side-nav .user-view>a,.side-nav .userView>a{height:auto;padding:0}.side-nav .user-view>a:hover,.side-nav .userView>a:hover{background-color:transparent}.side-nav .user-view .background,.side-nav .userView .background{overflow:hidden;position:absolute;top:0;right:0;bottom:0;left:0;z-index:-1}.side-nav .user-view .circle,.side-nav .user-view .name,.side-nav .user-view .email,.side-nav .userView .circle,.side-nav .userView .name,.side-nav .userView .email{display:block}.side-nav .user-view .circle,.side-nav .userView .circle{height:64px;width:64px}.side-nav .user-view .name,.side-nav .user-view .email,.side-nav .userView .name,.side-nav .userView .email{font-size:14px;line-height:24px}.side-nav .user-view .name,.side-nav .userView .name{margin-top:16px;font-weight:500}.side-nav .user-view .email,.side-nav .userView .email{padding-bottom:16px;font-weight:400}.drag-target{height:100%;width:10px;position:fixed;top:0;z-index:998}.side-nav.fixed{left:0;-webkit-transform:translateX(0);transform:translateX(0);position:fixed}.side-nav.fixed.right-aligned{right:0;left:auto}@media only screen and (max-width: 992px){.side-nav.fixed{-webkit-transform:translateX(-105%);transform:translateX(-105%)}.side-nav.fixed.right-aligned{-webkit-transform:translateX(105%);transform:translateX(105%)}.side-nav a{padding:0 16px}.side-nav .user-view,.side-nav .userView{padding:16px 16px 0}
      </style>
    </head>
    <body>
    <?php include "navbar.php"; ?>
    <div id="conteudo" style="border:none" class="row container col s12 m12 l12">
    <?php
    $id = $_GET['id'];
    $select = "SELECT * FROM locacao WHERE id = ".$id;
    $conecta = mysqli_query($connection, $select);
    if(mysqli_num_rows($conecta)>0){
        while($row = mysqli_fetch_assoc($conecta)) {
          $explode = explode(":", $row['material']);
          unset($explode[0]);    
    ?>
    <h3 class="flow-text">Visualiza cadastro</h3>
    <div id="logo" class="row">
      <div style="border:none" class="col s12">
          <center><img src="img/logo.png"  /></center>
        </div>
        <div style="border:none" class="col s12">
          <p align="center">
            SHERRER MONTAGENS E SERVÇOS LTDA.<br />
            (21) 3462-2820 / 99963-4039 / 97046-7297<br />
            sherrer.ms@gmail.com
          </p>
        </div>
      </div>
      <div id="printable">
               
        <div class="row" style='background-image:url("img/background-blue.jpg"); background-repeat:repeat'>
          <div class="col s10 " style="border-bottom:none; border-right:none"><p class="center-align" style="font-size:14px;"><strong>CONTRATO DE LOCAÇÃO DE BENS MÓVEIS</strong></p></div>
          <div class="col s2 " style="border-bottom:none;">
            <p>
              <strong>
              Nº
                <span style="font-size:20px;">
                  <?=$row["id"]?>
                </span>
              </strong>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col s12 lighten-3">
          <p>
            Pelo presente instrumento de contrato que tem de lado como <strong>LOCADORA</strong> a empresa
            <strong>SHERRER MONTAGENS E SERVÇOS LTDA.</strong> Estabelecida a Rua feira nova, 08 - Realengo - RJ
            inscrita no CNPJ Nº 19.068.820/0001-43 e Inscrição Municipal 590.715-0.
            Por seu representante legal infra assinado e, outro lado, como <strong>LOCATÁRIA</strong>.
          </p>
          </div>        
        </div>
        <div class="row" style='background-image:url("img/background-blue.jpg"); background-repeat:repeat'>
          <div class="col s12"><p class="center-align"><strong>DADOS DO CLIENTE</strong></p></div>
        </div>
        <div class="row">
          <div class="col s8 lighten-3"><p>NOME:<strong> <?=strtoupper($row['nome'])?> </strong></p></div>
          <div class="col s4 lighten-3"><p><?php if(strlen($row['registro'])>11){$tipoRegistro="cnpj"; echo "CNPJ:";}else{$tipoRegistro="cpf"; echo "CPF:";}?><strong> <?=formatar($tipoRegistro, $row['registro'], $size = 10)?></strong></p></div>
        </div>
        <div class="row">
          <div class="col s7 lighten-3"><p>ENDEREÇO:<strong>
          <?php
            $enderecoSplit = array();
            $enderecoSplit = explode(',', $row['endereco']);
            $splitEndBairro = array();
            $splitEndBairro = explode('-', $enderecoSplit[1]);
            $splitCidadeUf = array();
            $splitCidadeUf = explode('-', $enderecoSplit[2]);
            echo $enderecoSplit[0].", ".$splitEndBairro[0];
          ?>
          </strong></p></div>
          <div class="col s5 lighten-3"><p>BAIRRO:<strong>
          <?=$splitEndBairro[1]?>
          </strong></p></div>
        </div>
        <div class="row">
          <div class="col s4 lighten-3"><p>CIDADE:<strong>
          <?=$splitCidadeUf[0]?>
          </strong></p></div>
          <div class="col s4 lighten-3"><p>UF:<strong>
          <?php
          if(@$splitCidadeUf[1]==null){
            echo 'RJ';
          }else{
            echo @$splitCidadeUf[1];
          }
          ?>
          </strong></p></div>
          <div class="col s4 lighten-3"><p>CEP:<strong>
          <?php
          if(trim($enderecoSplit[3])=="BRASIL"){
            echo "";  
          }else{
            echo $enderecoSplit[3];
          }
          
          ?>
          </strong></p></div>
        </div>

        <div class="row">
          <div class="col s6 lighten-3"><p>TELEFONES:<strong> (<?=$row['ddd']?>) <?php if(strlen($row['telefone'])>8){$tipoFone=$row['telefone']; $size = 9;}else{$tipoFone=$row['telefone'];  $size = 8;}?> <?=formatar("fone", $tipoFone, $size)?> / (<?=$row['ddd2']?>) <?php if(strlen($row['telefone2'])>8){$tipoFone=$row['telefone2']; $size = 9;}else{$tipoFone=$row['telefone2'];  $size = 8;}?><strong> <?=formatar("fone", $tipoFone, $size)?></strong></p></div>
          <div class="col s6 lighten-3"><p>E-MAIL:<strong> <?=$row['email']?></strong></p></div>
        </div>
        <div class="row" style='background-image:url("img/background-blue.jpg"); background-repeat:repeat'>
          <div class="col s12"><p class="center-align"><strong>PERÍODO DE LOCAÇÃO</strong></p></div>
        </div>
        <div class="row">
          <div class="col s4 lighten-3"><p>ENTREGA:<strong> <span style="font-size:10px;"><?=diadasemana(date("w", strtotime($row["entrega"])))?></span>, <?=date("d/m/Y", strtotime($row["entrega"]))?></strong></p></div>
          <div class="col s4 lighten-3"><p>RETIRADA:<strong> <span style="font-size:10px;"><?=diadasemana(date("w", strtotime($row["retirada"])))?></span>, <?=date("d/m/Y", strtotime($row["retirada"]))?></strong></p></div>
          <div class="col s4 lighten-3"><p>PRAZO:<strong> <?=datadiff($row["entrega"],$row["retirada"])." DIAS CORRIDOS"; ?></strong></p></div>
        </div>
        <div class="row" style='background-image:url("img/background-blue.jpg"); background-repeat:repeat'>
          <div class="col s12"><p class="center-align"><strong>EQUIPAMENTOS</strong></p></div>
        </div>
        <div class="row">
          <table class="bordered striped responsive-table">
              <thead>
              <tr>
                  <th><center>UNIDADE</center></th>
                  <th><center>QUANTIDADE</center></th>
                  <th>DESCRIÇÃO</th>
                  <th><center>UNITÁRIO</center></th>
                  <th><center>TOTAL</center></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                foreach ($explode as $value) {
                  $separador = array();
                  $separador = explode(',', $value);
                  foreach($separador as $chave => $key){
                    if(stristr($key, 'TORRE')==TRUE){
                      $observacao[] = $separador[$chave];
                      unset($separador[$chave]);
                    }
                  }
                  foreach ($separador as $separado) {
                    preg_match('/[0-9]+/', strtoupper(substr(trim($separado), 0 ,2)), $numeros);
                    ?>
                    <td><center><strong>PÇ</strong></center></td>
                    <?PHP
                    if(strlen($numeros[0])<2){
                    ?>
                      <td><center><strong>0<?=$numeros[0]?></strong></center></td>
                    <?php
                    //echo "0".$numeros[0]." - ".strtoupper(substr(trim($separado), 2))."<br />";  
                    }else{
                    ?>  
                      <td><strong><center><?=$numeros[0]?></center></strong></td>
                  <?php  
                  }                    
                  ?>     
                  <td><strong>
                  <?php
                  //$chave = array_search('- R$', $separado);
                  if(stristr($separado, '- R$')==TRUE){
                    //unset($separador[$chave]);
                    $exibirValor = array();
                    $exibirValor = explode('- R$', $separado);
                    //print_r($exibirValor);
                    echo strtoupper(substr(trim($exibirValor[0]), 2));
                  }else{
                    echo strtoupper(substr(trim($separado), 2));                     
                  }
                ?>
                  </strong></td>
                  <td><strong><center>R$ -0-</center></strong></td>
                  <td><strong><center>R$ -0-</center></strong></td>
                </tr>
                <?php 
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col s8 lighten-3"><p style="color:#950000;">OBS.:<strong>
            <?php 
            if(empty($observacao)){
              $observacao = $separador;
            }
            foreach($observacao as $exibirObs){
              
              if(stristr($exibirObs, '- R$')==TRUE){
                //unset($separador[$chave]);
                $novaObs = array();
                $novaObs = explode('- R$', $exibirObs);
                //print_r($exibirValor);
                //echo strtoupper(substr(trim($novaObs[0]), 2));
                echo strtoupper(trim($novaObs[0]));
              }else{
                echo strtoupper(trim($exibirObs));                     
              }   
            ?>
            <?//=strtoupper($exibirObs)?>
            <?php
            }
            ?>
            <?=strtoupper($row['obs'])?> 
            </strong></p>
          </div>
          <div class="col s4" style='background-image:url("img/background-blue.jpg"); background-repeat:repeat;'><p>TOTAL:<strong> <?=my_money_format($row['valor'], '%n')?> (<?=forma_pgto($row['forma_pgto'])?>)</strong></p></div>
        </div>
        <div class="row">
          <div class="col s6 lighten-3"><p class="center-align"><br/><strong> <?=vendedor($row['vendedor'])?> em <?=date("d/m/Y H:i:s", strtotime($row["emissao"]))?></strong><br/><span style="font-size:9px;">VENDEDOR</span></p></div>
          <div class="col s6 lighten-3"><p class="center-align"><br/><strong>________________________________________</strong><br/><span style="font-size:9px;">ASSINATURA DO CLIENTE</span></p></div>
        </div>
        
        <div class="row">
          <div style="border:none" class="col s12">
            <p style="font-size:10px;">
              <strong><font color="#950000">Será de responsabilidade da contratante:</font></strong><br/>
              <strong>1</strong> - Em caso de cancelamento dos serviços aqui contratados, será cobrado o frete correspondente ao valor de R$50,00 (cinquenta reais);<br/>
              <strong>2</strong> - A responsabilidade pela conservação e bom funcionamento do bem móvel locado;<br/>
              <strong>3</strong> - A manutenção e substituição de peças danificadas durante o período em que o bem estiver sob sua responsabilidade;<br/>
              <strong>4</strong> - Quaisquer acidentes ocorridos com os equipamentos locados ou por eles causados a terceiros, fica a LOCADORA excluída de quaisquer responsabilidades civis, criminais, trabalhistas ou outras;<br/>
              <strong>5</strong> - Devolução dentro do prazo estipulado no momento do contrato firmado entre as partes.
            </p>
          </div>        
        </div>

      </div>
      <div style="border:none" class="card-action right-align">
        <a onClick="printArea()" class="waves-effect waves-light btn">Imprimir <i class="material-icons right">print</i></a>
      
        <a href="cadastro-cliente.php?id=<?=$row["id"];?>" class="waves-effect waves-light btn">Copiar <i class="material-icons right">library_add</i></a>

        <a href="cadastro-cliente.php?id=<?=$row["id"];?>&renovacao=0" class="waves-effect waves-light btn">Renovar <i class="material-icons right">autorenew</i></a>

        <a href="confirma-edicao-cliente.php?id=<?=$row["id"];?>" class="waves-effect waves-light btn">Editar <i class="material-icons right">edit</i></a>
        
        <a href="javascript:history.back()" class="waves-effect waves-light btn">Fechar <i class="material-icons right">zoom_out</i></a>
      </div>
    <?php
        }    
    }
    ?>  
    <!-- Page Content goes here -->
    </div>          
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script>
      function printArea(){
        $('#topo').css('display', 'none');
        $('body').css('visibility', 'hidden');
        $('#logo').css('visibility', 'visible');
        $('#printable').css('visibility', 'visible');
        window.print();
        $('#topo').css('display', 'block');
        $('body').css('visibility', 'visible');
      }
    </script>
    <script>
    $(document).ready(function() {  
      $(".button-collapse").sideNav();
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
    });  
    </script>
    </body>
  </html>
  