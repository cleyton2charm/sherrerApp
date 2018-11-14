<!DOCTYPE html>
<?php
include "conexao.php";
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_MONETARY, "pt_BR", "ptb");
?>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="fonts/roboto/" rel="stylesheet">
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="css/materialize.min.css">  
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style>
      td {
        font-size: 12px;
        border-right:1px solid #ccc;
        border-bottom:1px solid #ccc;
      }
      </style>
    </head>
    <body>
    <?php include "topo.php"; ?>
    <div class="container">
    <h3 class="flow-text">Controle de equipamentos</h3>
    <table class="responsive-table centered striped">
        <thead>
          <tr>
              <th>Equipamento</th>
              <th>Alugado</th>
              <th>No Galpão</th>
              <th>Total</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $data = date("Y-m-d 00:00:00");
        $select = "SELECT * FROM locacao WHERE retirada >= '".$data."' AND status NOT IN (9,12)";
        $conecta = mysqli_query($connection, $select);
        if(mysqli_num_rows($conecta)>0){
          $valorTotal = 0;
          //Peças 100X100
          $totalandaime100x100 = 501;
          $andaime100x100 = 0;
          //
          $totalplataformas100 = 75;
          $plataformas100 = 0;
          //
          $totaltravessas100 = 184;
          $travessas100 = 0;
          //
          $totaldiagonais100 = 102;
          $diagonais100 = 0;
          //
          $totalsapatasP = 175;
          $sapatasP = 0;
          //
          $totalrodinhasP = 24;
          $rodinhasP = 0;
          //Peças 150X150
          $totalandaime150x150 = 52;          
          $andaime150x150 = 0;
          //
          $totalplataformas150 = 14;
          $plataformas150 = 0;
          //
          $totalplataformas160 = 14;
          $plataformas160 = 0;
          //
          $totaltravessas150 = 30;
          $travessas150 = 0;
          //
          $totaltesouras = 22;
          $tesouras = 0;
          //Peças 150X100
          $totalandaime150x100 = 66;
          $andaime150x100 = 0;
          //
          $totaltravessas150x100 = 18;
          $travessas150x100 = 0;
          //
          $totaldiagonais150x100 = 5;
          $diagonais150x100 = 0;
          //
          $totalsapatasG = 20;
          $sapatasG = 0;
          //
          $totalrodinhasG = 8;
          $rodinhasG = 0;
          //
          $totalescoras = 96;
          $escoras = 0;
          //
          $totalescadas = 3;
          $escadas = 0;
          //
          $totalcintos = 0;
          $cintos = 0;
          //
          $totalcadeirinhas = 3;
          $cadeirinhas = 0;
          //
          $totalcompressor = 2;
          $compressor = 0;          
          while($row = mysqli_fetch_assoc($conecta)) {
            $valorTotal += $row["valor"];
            $explode = explode(":", $row['material']);
            unset($explode[0]);
            foreach ($explode as $value) {
              $separador = array();
              $separador = explode(',', $value);
              foreach($separador as $chave => $key){
                if(stristr($key, 'TORRE')==TRUE){
                  $observacao[] = $separador[$chave];
                  unset($separador[$chave]);
                  substr(strstr(substr($row["endereco"], 0, -13), '-'), 1);
                }
              }
            }
            foreach ($separador as $separado) {
              echo preg_match('/[0-9]+/', strtoupper(substr(trim($separado), 0 ,2)), $numeros);
              ?>
              <!--<td><center><strong>PÇ</strong></center></td>-->
              <?PHP
              if(strlen($numeros[0])<2){
              ?>
              <!--<td><center><strong>0<?=$numeros[0]?></strong></center></td>-->
              <?php
              //echo "0".$numeros[0]." - ".strtoupper(substr(trim($separado), 2))."<br />";  
              }else{
              ?>  
              <!--<td><strong><center><?=$numeros[0]?></center></strong></td>-->
              <?php  
              }
              echo $resultado = strtoupper(substr(trim($separado), 2));
              
              if(strstr($numeros[0], '24')==true){
                //$andaime100x100 += $numeros[0];
                echo "TRUE<br>";
              }else{
                echo "FALSE<br>";
              }
              
              //echo $andaime100x100."Fora do if<br/>";
              //echo $numeros[0]." - ".$resultado."<br />";                    
              
              switch($resultado){
                 case strstr($resultado, '1.00X1.00')==true:
                 $andaime100x100 += $numeros[0];
                 break;
                 case strstr($resultado, 'PLATAFORMAS METáLICAS 1.00')==true:
                 $plataformas100 += $numeros[0];
                 break;
                 case strstr($resultado, 'TRAVESSAS 1.00')==true:
                 $travessas100 += $numeros[0];
                 break;
                 case strstr($resultado, 'DIAGONAIS 1.40')==true:
                 $diagonais100 += $numeros[0];
                 break;
                 case strstr($resultado, 'VEIS (P)')==true:
                 $sapatasP += $numeros[0];
                 break;
                 case strstr($resultado, 'TRAVAS (P)')==true:
                 $rodinhasP += $numeros[0];
                 break;
                 case strstr($resultado, '1.50X1.50')==true:
                 $andaime150x150 += $numeros[0];
                 break;
                 case strstr($resultado, 'PLATAFORMAS METáLICAS 1.60')==true:
                 $plataformas160 += $numeros[0];
                 break;
                 case strstr($resultado, 'TRAVESSAS 1.50')==true:
                 $travessas150 += $numeros[0];
                 break;
                 case strstr($resultado, 'TESOURAS 1.72')==true:
                 $tesouras += $numeros[0];
                 break;
                 case strstr($resultado, '1.50X1.00')==true:
                 $andaime150x100 += $numeros[0];
                 break;
                 case strstr($resultado, 'PLATAFORMAS METáLICAS 1.42')==true:
                 $plataformas150 += $numeros[0];
                 break;
                 //<!-- Esta travessa a cima é utilizada somente com andaimes de tesoura-->
                 case strstr($resultado, 'TRAVESSAS 1.60')==true:
                 $travessas150x100 += $numeros[0];
                 break;
                 case strstr($resultado, 'DIAGONAIS 2.20')==true:
                 $diagonais150x100 += $numeros[0];
                 break;             
                 case strstr($resultado, 'VEIS (G)')==true:
                 $sapatasG += $numeros[0];
                 break;
                 case strstr($resultado, 'TRAVAS (P)')==true:
                 $rodinhasG += $numeros[0];
                 break;
                 case strstr($resultado, 'ESCADA')==true:
                 $escadas += $numeros[0];
                 break;
                 case strstr($resultado, 'CINTO')==true:
                 $cintos += $numeros[0];
                 break;
                 case strstr($resultado, 'ESCORA')==true:
                 $escoras += $numeros[0];
                 break;
                 case strstr($resultado, 'CADEIRINHA')==true:
                 $cadeirinhas += $numeros[0];
                 break;
                 case strstr($resultado, 'COMPRESSOR')==true:
                 $compressor += $numeros[0];
                 break;
                 default:
                 $totalPecas = $numeros[0];
              }
              
            ?>     
            <!--<td><strong><?=strtoupper(substr(trim($separado), 2))?></strong></td>-->
            <!--<td><strong><center>R$ -0-</center></strong></td>-->
            <!--<td><strong><center>R$ -0-</center></strong></td>-->

            </tr>
            <?php
            }       
          ?>
          <!--
          <tr class="linha">
            <td><?=strstr($row["nome"], ' ', true)?><br />(<?=$row["ddd"]?>)<?php if(strlen($row['telefone'])>8){$tipoFone=$row['telefone']; $size = 9;}else{$tipoFone=$row['telefone'];  $size = 8;}?><?=formatar("fone", $tipoFone, $size)?></td>
            <td>(<?=$row["ddd"]?>) <?=$row["telefone"]?> (<?=$row["ddd2"]?>) <?=$row["telefone2"]?></td>
            <td><?=substr(strstr(substr($row["endereco"], 0, -13), '-'), 1)?></td>
            <td><?=substr($row["material"], 1,37)?></td>
            <td>R$ <?=number_format($row["valor"], 2, ',', '.')?> <?=forma_pgto($row["forma_pgto"])?></td>
            <td><?=situacao($row["situacao"])?></td>
            <?php
            if(date("d/m/Y", strtotime($row["retirada"]))==date("d/m/Y")){
            ?>
            <td style="color:#8B0000; background-color:#FFE4E1">
            <?php
            }else{
            ?>
            <td style="background-color:#FFE4E1">
            <?php
            }
            ?>
              <strong><?=date("d/m/Y", strtotime($row["retirada"]))." ".diadasemana(date("w", strtotime($row["retirada"])))?></strong>
            </td>
            <td>
            <a href="cadastro-cliente.php?id=<?=$row["id"]?>" class="btn-floating"><i class="material-icons">library_add</i></a></td>
            <td><a href="vizualiza-dados.php?id=<?=$row["id"]?>" class="btn-floating"><i class="material-icons">zoom_in</i></a></td>
            <td><a href="confirma-edicao-cliente.php?id=<?=$row["id"]?>" class="btn-floating"><i class="material-icons right">edit</i></a></td>
          </tr> 
          -->     
        <?php

          }
        ?>
          
          <!-- Andaimes 1.00x1.00 -->
          <tr class="linha">
            <td>Andaimes 1.00x1.00</td>
            <td class="alugado"><?=$andaime100x100?></td>
            <td><?=$totalandaime100x100-$andaime100x100?></td>
            <td><?=$totalandaime100x100?></td>
          </tr>
          <tr class="linha">
            <td>Plataformas 1.00x1.00</td>
            <td><?=$plataformas100?></td>
            <td><?=$totalplataformas100-$plataformas100?></td>
            <td><?=$totalplataformas100?></td>
          </tr>
          <tr class="linha">
            <td>Travessas 1.00x1.00</td>
            <td><?=$travessas100?></td>
            <td><?=$totaltravessas100-$travessas100?></td>
            <td><?=$totaltravessas100?></td>
          </tr>
          <tr class="linha">
            <td>Diagonais 1.00x1.00</td>
            <td><?=$diagonais100?></td>
            <td><?=$totaldiagonais100-$diagonais100?></td>
            <td><?=$totaldiagonais100?></td>
          </tr>
          <tr class="linha">
            <td>Sapatas Ajustáveis 1.00x1.00</td>
            <td><?=$sapatasP?></td>
            <td><?=$totalsapatasP-$sapatasP?></td>
            <td><?=$totalsapatasP?></td>
          </tr>
          <tr class="linha">
            <td>Rodinhas com travas 1.00x1.00</td>
            <td><?=$rodinhasP?></td>
            <td><?=$totalrodinhasP-$rodinhasP?></td>
            <td><?=$totalrodinhasP?></td>
          </tr>
          <!-- Andaimes 1.50x1.50 -->
          <tr class="linha">
            <td>Andaimes 1.50x1.50</td>
            <td><?=$andaime150x150?></td>
            <td><?=$totalandaime150x150-$andaime150x150?></td>
            <td><?=$totalandaime150x150?></td>
          </tr>
          <tr class="linha">
            <td>Plataformas 1.50</td>
            <td><?=$plataformas150?></td>
            <td><?=$totalplataformas150-$plataformas150?></td>
            <td><?=$totalplataformas150?></td>
          </tr>
          <tr class="linha">
            <td>Plataformas 1.60</td>
            <td><?=$plataformas160?></td>
            <td><?=$totalplataformas160-$plataformas160?></td>
            <td><?=$totalplataformas160?></td>
          </tr>
          <tr class="linha">
            <td>travessas 1.50x1.50</td>
            <td><?=$travessas150?></td>
            <td><?=$totaltravessas150-$travessas150?></td>
            <td><?=$totaltravessas150?></td>
          </tr>
          <tr class="linha">
            <td>tesouras 1.50x1.50</td>
            <td><?=$tesouras?></td>
            <td><?=$totaltesouras-$tesouras?></td>
            <td><?=$totaltesouras?></td>
          </tr>
          <!-- Andaimes 1.50x1.00 -->
          <tr class="linha">
            <td>Andaimes 1.50x1.00</td>
            <td><?=$andaime150x100?></td>
            <td><?=$totalandaime150x100-$andaime150x100?></td>
            <td><?=$totalandaime150x100?></td>
          </tr>
          <tr class="linha">
            <td>Travessas 1.50x1.00</td>
            <td><?=$travessas150x100?></td>
            <td><?=$totaltravessas150x100-$travessas150x100?></td>
            <td><?=$totaltravessas150x100?></td>
          </tr>
          <tr class="linha">
            <td>Diagonais 1.50x1.00</td>
            <td><?=$diagonais150x100?></td>
            <td><?=$totaldiagonais150x100-$diagonais150x100?></td>
            <td><?=$totaldiagonais150x100?></td>
          </tr>
          <!-- Comuns a 1.50x1.50 e 1.50x1.00 -->
          <tr class="linha">
            <td>Sapatas Ajustáveis Grandes</td>
            <td><?=$sapatasG?></td>
            <td><?=$totalsapatasG-$sapatasG?></td>
            <td><?=$totalsapatasG?></td>
          </tr>
          <tr class="linha">
            <td>Rodinhas com travas Grande</td>
            <td><?=$rodinhasG?></td>
            <td><?=$totalrodinhasG-$rodinhasG?></td>
            <td><?=$totalrodinhasG?></td>
          </tr>
          <!-- Diversos -->
          <tr class="linha">
            <td>Escoras</td>
            <td><?=$escoras?></td>
            <td><?=$totalescoras-$escoras?></td>
            <td><?=$totalescoras?></td>
          </tr>
          <tr class="linha">
            <td>Escadas</td>
            <td><?=$escadas?></td>
            <td><?=$totalescadas-$escadas?></td>
            <td><?=$totalescadas?></td>
          </tr>
          <tr class="linha">
            <td>Cinto de seguraça</td>
            <td><?=$cintos?></td>
            <td><?=$totalcintos-$cintos?></td>
            <td><?=$totalcintos?></td>
          </tr>
          <tr class="linha">
            <td>Cadeirinhas Suspensas</td>
            <td><?=$cadeirinhas?></td>
            <td><?=$totalcadeirinhas-$cadeirinhas?></td>
            <td><?=$totalcadeirinhas?></td>
          </tr>
          <tr class="linha">
            <td>Compressores de Ar</td>
            <td><?=$compressor?></td>
            <td><?=$totalcompressor-$compressor?></td>
            <td><?=$totalcompressor?></td>
          </tr>    
          <!-- Valor Total -->
          <tr class="linha"> 
            <td style="background-color:#FFE4E1">
              <strong>
              <?=my_money_format($valorTotal, '%n')?>
              </strong>
              <br/>
              Valor Total Alugado
            </td>
          </tr>
        <?php
        
        }      
        ?>
        </tbody>
      </table>
      <!--
      <iframe src="https://embed.waze.com/iframe?zoom=16&lat=-22.8916&lon=-43.43271&pin=1"
  width="100%" height="400"></iframe>
      -->           
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script>
        $(document).ready(function() {
          $(".button-collapse").sideNav(); 
          $('.modal').modal();
        });
      </script>
    </body>
  </html>