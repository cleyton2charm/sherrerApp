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
      td {
          font-size: 12px;
      }
      #map {
        height: 500px;
        height: 500px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      .side-nav .user-view,.side-nav .userView{position:relative;padding:32px 32px 0;margin-bottom:8px}.side-nav .user-view>a,.side-nav .userView>a{height:auto;padding:0}.side-nav .user-view>a:hover,.side-nav .userView>a:hover{background-color:transparent}.side-nav .user-view .background,.side-nav .userView .background{overflow:hidden;position:absolute;top:0;right:0;bottom:0;left:0;z-index:-1}.side-nav .user-view .circle,.side-nav .user-view .name,.side-nav .user-view .email,.side-nav .userView .circle,.side-nav .userView .name,.side-nav .userView .email{display:block}.side-nav .user-view .circle,.side-nav .userView .circle{height:64px;width:64px}.side-nav .user-view .name,.side-nav .user-view .email,.side-nav .userView .name,.side-nav .userView .email{font-size:14px;line-height:24px}.side-nav .user-view .name,.side-nav .userView .name{margin-top:16px;font-weight:500}.side-nav .user-view .email,.side-nav .userView .email{padding-bottom:16px;font-weight:400}.drag-target{height:100%;width:10px;position:fixed;top:0;z-index:998}.side-nav.fixed{left:0;-webkit-transform:translateX(0);transform:translateX(0);position:fixed}.side-nav.fixed.right-aligned{right:0;left:auto}@media only screen and (max-width: 992px){.side-nav.fixed{-webkit-transform:translateX(-105%);transform:translateX(-105%)}.side-nav.fixed.right-aligned{-webkit-transform:translateX(105%);transform:translateX(105%)}.side-nav a{padding:0 16px}.side-nav .user-view,.side-nav .userView{padding:16px 16px 0}
      </style>
    </head>
    <body>
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <div class="row col s12 m12 l12">
   <?php
    if(@$_POST["envio"]=="ok"){
      $busca = strtoupper($_POST['busca']);
        $situacao = $_POST['situacao'];
        $inicio = $_POST['inicio'];
        $fim = $_POST['fim'];
        if(!empty($situacao)){
           $situacao = " AND situacao = ".$situacao; 
        }else{
           $situacao = "";  
        }
        if(!empty($inicio)){
           $periodo = "emissao BETWEEN '".dtentrada($inicio)." 00:00:00' AND '".dtentrada($fim)." 23:59:59'"; 
        }else{
           $periodo = "emissao BETWEEN '1900-01-01 00:00:00' AND '".date('Y-m-d')." 23:59:59'";  
        }
        if(!empty($busca)){
          if(is_numeric($busca)){
             $campo = "telefone LIKE '%".$busca."%' OR telefone2 LIKE '%".$busca."%' AND "; 
          }else{
             $campo = "nome LIKE '%".$busca."%' OR endereco LIKE '%".$busca."%' AND ";  
          }
        }else{
           $campo = ""; 
        }  
        $select = "SELECT * FROM locacao WHERE ".$campo.$periodo.$situacao." ORDER BY entrega DESC";
        $conecta = mysqli_query($connection, $select);
        if(mysqli_num_rows($conecta)>0){
          $resultados = mysqli_num_rows($conecta);       
      ?>
    <div class="card-panel">
      <span class="new badge" data-badge-caption="">Todos</span>
        <h3 class="flow-text"><i class="material-icons">call_made</i> Resultados Encontrados (<?=$resultados?>)</h3>
        <table class="responsive-table centered striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Cliente</th>
              <!--<th>Telefone</th>-->
              <th>Endereço</th>
              <th>Material</th>
              <th>Valor</th>
              <th>Entrega</th>
              <th>Retirada</th>
              <th>Status</th>
              <th></th>   
            </tr>
          </thead>
          <tbody>
            <?php 
              $valorTotal = 0;
              $arrayEndereco = "";
              while($row = mysqli_fetch_assoc($conecta)) {
                $valorTotal += $row["valor"];
                $arrayEndereco .= "'".$row["endereco"]."',";
            ?>
            <tr class="linha">
              <td><?=$row["id"]?></td>
              <td><?=strstr($row["nome"], ' ', true)?><br />(<?=$row["ddd"]?>)<?php if(strlen($row['telefone'])>8){$tipoFone=$row['telefone']; $size = 9;}else{$tipoFone=$row['telefone'];  $size = 8;}?><?=formatar("fone", $tipoFone, $size)?></td>
              <!--<td>(<?=$row["ddd"]?>) <?=$row["telefone"]?> (<?=$row["ddd2"]?>) <?=$row["telefone2"]?></td>-->
              <td><?=substr(strstr(substr($row["endereco"], 0, -13), '-'), 1)?></td>
              <td><?=substr($row["material"], 1,37)?></td>
              <td>R$ <?=number_format($row["valor"], 2, ',', '.')?><br/>
                <a style="padding:5px; font-size: 9px;" class="white-text waves-effect waves-light btn-small <?php if(situacao($row['situacao'])=='PAGO'){echo 'green';}else{echo 'red';}?>"><?=situacao($row["situacao"])?> <?=forma_pgto($row["forma_pgto"])?></a>
              </td>
              <td>
                <?php
                if(strstr($row["obs"], 'RENOVA')==true){ 
                ?>  
                <br/><a style="padding:5px; font-size: 9px;" class="white-text waves-effect waves-light btn-small blue">RENOVADO<br /><?=date("d/m/Y", strtotime($row["emissao"]))?></a>
                <?php
                }else{
                  echo date("d/m/Y", strtotime($row["entrega"]))."<br/>".diadasemana(date("w", strtotime($row["entrega"])));
                }
                ?>
              </td>
              <?php
              if(date("d/m/Y", strtotime($row["retirada"]))==date("d/m/Y")){
                $bgcolor = 'style="color:#8B0000; background-color:#FFE4E1"';
              }else{
                $bgcolor = 'style="background-color:#FFE4E1"';
              }
              ?>
              <td <?=$bgcolor?>>
              <strong><?=date("d/m/Y", strtotime($row["retirada"]))."<br/>".diadasemana(date("w", strtotime($row["retirada"])))?></strong>
              </td>
              <td><?=status($row["status"])?></td>
              <td>
              <a class='dropdown-button black-text waves-effect waves-light btn-small transparent' href='#' data-activates='dropdownferramenta<?=$row["id"]?>'>
                <i class="material-icons">info_outline</i>
              </a>
              <!-- Dropdown Structure -->
              <ul id='dropdownferramenta<?=$row["id"]?>' class='dropdown-content'>  
                <li>
                  <a href="vizualiza-dados.php?id=<?=$row["id"]?>" class="btn-small"><i class="black-text material-icons">zoom_in</i>Abrir</a>
                </li>
                <li>
                  <a href="imprimir.php?id=<?=$row["id"]?>" class="btnPrint btn-small"><i class="black-text material-icons">print</i>Imprimir</a>
                </li>          
                <li>
                <a href="confirma-edicao-cliente.php?id=<?=$row["id"]?>" class="btn-small"><i class="black-text material-icons">edit</i>Editar</a>
                </li>
                <li>
                  <a href="cadastro-cliente.php?id=<?=$row["id"]?>&renovacao=0" class="btn-small"><i class="black-text material-icons">autorenew</i>Renovar</a>
                </li>
                <li>
                  <a href="cadastro-cliente.php?id=<?=$row["id"]?>" class="btn-small"><i class="black-text material-icons">library_add</i>Copiar</a>
                </li>  
              </ul>
              </td>
              <!--
              <td>  
              <a href="cadastro-cliente.php?id=<?=$row["id"]?>&renovacao=0" class="btn-small"><i class="black-text material-icons">autorenew</i></a></td>
              <td><a href="vizualiza-dados.php?id=<?=$row["id"]?>" class="btn-small"><i class="black-text material-icons">zoom_in</i></a></td>
              <td><a href="confirma-edicao-cliente.php?id=<?=$row["id"]?>" class="btn-small"><i class="black-text material-icons">edit</i></a></td>
              -->
            </tr>
            <?php  
            }
            ?>
            <tr class="linha">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="background-color:#FFE4E1">
              <strong>
              <?=my_money_format($valorTotal, '%n')?>
              </strong>
              <br/>
              Valor Total
            </td>
          </tr> 
        </tbody>
        </table>
      
      </div>  
    </div>
        <div class="card-action right-align">
          <a href="busca-cliente.php" class="waves-effect waves-light btn-large">Buscar Novamente</a>
        </div>
        <div id="map"></div>
        <?php    
          }else{
        ?>  
        <a href="busca-cliente.php" class="waves-effect waves-light btn-large">Nenhum item foi encontrado! Tente novamente</a>
        <?php  
        }
      }else{
      ?>      
      
      <div class="card-action right-align">
        <form class="col s12" action="busca-cliente.php" method="post">
          <input name="envio" value="ok" type="hidden">
            <div class="row col s6 m6 l6">
              <div class="input-field col s6 m6 l6">
                <i class="material-icons prefix">date_range</i>
                <input name="inicio" type="date" class="datepicker">
              </div>
              <div class="input-field col s6 m6 l6">    
                <input name="fim" type="date" class="datepicker">
              </div>  
            </div>
            <div class="row col s6 m6 l6">
              <div class="input-field col s12 m12 l12"> 
                <select name="situacao" class="icons">
                  <option value="">Escolha o Situação</option>
                  <option value="1">Á PAGAR</option>
                  <option value="2">PAGO</option>
                  <option value="3">PAGO PARCIALMENTE</option>
                  <option value="4">CANCELADO</option>
                  <option value="5">PAGAMENTO NA RETIRADA</option>
                </select>
                <!--<i class="material-icons prefix">thumbs_up_down</i>-->           
              </div>
            </div>  
            <div class="row col s12 m12 l12">
              <div class="input-field col s12 m12 l12">    
                <i class="material-icons prefix">search</i>
                <input placeholder="Buscar por nome, telefone ou endereço" name="busca" type="text">
                <!--<label for="busca">Buscar</label>-->
              </div>  
            </div>
          <button class="btn-large waves-effect waves-light" type="submit" name="action">Buscar
            <i class="material-icons right">zoom_in</i>
          </button>
        </form>
      </div>
    <!-- Page Content goes here -->
    <?php
    }
    ?>
    </div>          
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="http://www.position-absolute.com/creation/print/jquery.printPage.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $(".button-collapse").sideNav();
        $('select').material_select();
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
        $(".btnPrint").printPage();
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
    <script>
      document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems, {
      direction: 'left',
      hoverEnabled: false
    });
  });
    </script>
    <script type="text/javascript">
  var delay = 100;
  var infowindow = new google.maps.InfoWindow();
  var latlng = new google.maps.LatLng(-22.8916024, -43.4348961);
  var mapOptions = {
    zoom: 11,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var geocoder = new google.maps.Geocoder(); 
  var map = new google.maps.Map(document.getElementById("map"), mapOptions);
  var bounds = new google.maps.LatLngBounds();

  function geocodeAddress(address, next) {
    geocoder.geocode({address:address}, function (results,status)
      { 
         if (status == google.maps.GeocoderStatus.OK) {
          var p = results[0].geometry.location;
          var lat=p.lat();
          var lng=p.lng();
          createMarker(address,lat,lng);
        }
        else {
           if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
            nextAddress--;
            delay++;
          } else {
                        }   
        }
        next();
      }
    );
  }
 function createMarker(add,lat,lng) {
   var contentString = add;
   var marker = new google.maps.Marker({
     position: new google.maps.LatLng(lat,lng),
     map: map,
           });

  google.maps.event.addListener(marker, 'click', function() {
     infowindow.setContent(contentString); 
     infowindow.open(map,marker);
   });

   bounds.extend(marker.position);

 }
 //alert(<?=$arrayEndereco?>);
  var locations = [<?=$arrayEndereco?>];
  var nextAddress = 0;
  function theNext() {
    if (nextAddress < locations.length) {
      setTimeout('geocodeAddress("'+locations[nextAddress]+'",theNext)', delay);
      nextAddress++;
    } else {
      map.fitBounds(bounds);
    }
  }
  theNext();

</script>
    </body>
  </html>
  