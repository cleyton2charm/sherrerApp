<?php
include "conexao.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Controle de entregas/retiradas</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="fonts/roboto/" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="css/materialize.min.css">  
    <!--Let browser know website is optimized for mobile--> 
    <style>
      /*
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
      	margin: 0 auto;
        width: 100%;
        height: 50%;
      }
      td{
      	border-left:1px solid #ccc;
      	font-size: 12px;
      }
      /*
      #right-panel {
        margin: 20px;
        border-width: 2px;
        width: 20%;
        height: 400px;
        float: left;
        text-align: left;
        padding-top: 0;
      }
      #directions-panel {
        margin-top: 10px;
        background-color: #FFEE77;
        padding: 10px;
      }
      */
    </style>
  </head>
  <body>

  	<?php
    $data = date(dtentrada($_POST['data'])." 00:00:00");
    $select =  "SELECT * FROM locacao WHERE entrega = '".$data."' OR retirada = '".$data."' AND status NOT IN (4,9,12)";
    $conecta = mysqli_query($connection, $select);
    if(mysqli_num_rows($conecta)>0){
      $locacoesAtivas = mysqli_num_rows($conecta);
      $arrayEndereco = "";
      $array = array();
      //$obj = [];
      while($row = mysqli_fetch_assoc($conecta)) {
      	//echo $row["endereco"]."<br>";
      	if($row["status"]==4 OR $row["status"]==12){

      	}elseif($row["entrega"]==$data AND strstr($row["obs"], 'RENOVA')==true){	

      	}else{
      		if($row["entrega"]==$data){
       			$ordem = "Entrega";
       		}elseif($row["retirada"]==$data){
       			$ordem = "Retirada";
       		}else{
       			$ordem = "Destino";
       		}
      		//echo $arrayEndereco .= "'".$row["endereco"]."',";
      		//echo $arrayEndereco .= "'".$row["endereco"]." - ".$ordem."',";
      		if(strlen($row['telefone'])>8){$tipoFone=$row['telefone']; $size = 9;}else{$tipoFone=$row['telefone'];  $size = 8;}
      		array_push($array, array("NOTA: ".$row['id']." <br>NOME: ".strstr($row['nome'], ' ', true)." <br>FONE:  (".$row["ddd"].") ".formatar("fone", $tipoFone, $size), $row["endereco"], $ordem, situacao($row["situacao"])));
       	}
      } 
      $array; 
    }
  	?>
  
    <table style="height: 100%; width: 100%; min-height:100%; " class="responsive-table bordered">
        <thead>
        	<tr style="background-color:#ddd">
            	<th>Ordem</th>
            	<th>Cliente</th>
            	<th>Local</th>
            	<th>Execução</th>
            	<th>Distância</th>
            	<th>Situação</th>
        	</tr>
        </thead>
        <tbody id="directions-panel">	
        </tbody>
      </table>
      
    <!--
    <div id="right-panel">	
    <div id="directions-panel"></div>
    -->
    
    <div class="z-depth-4" id="map"></div>
    <script>

      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: {lat: -22.895682, lng: -43.448838}
        });
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('right-panel'));

        window.addEventListener('load', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
        var checkboxArray = [<?=json_encode($array)?>];
        //alert(checkboxArray[0].length);
        for (var i = 0; i < checkboxArray[0].length; i++) {
          	//alert(checkboxArray[0][i][1]);
            waypts.push({
              location: checkboxArray[0][i][1],
              stopover: true
            });
          
        }

        directionsService.route({
          origin: "R. Feira Nova, 8 - Realengo, Rio de Janeiro - RJ, Brasil",
          destination: "R. Feira Nova, 8 - Realengo, Rio de Janeiro - RJ, Brasil",
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            var distanciaTotal = 0;
            var ordem = '';
            var nome = '';
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              var enderecofull2 = route.legs;
              var enderecofull = route.legs[i].end_address;
              var endereco = route.legs[i].end_address.slice(0, -23);
              //summaryPanel.innerHTML += '<tr>';
              ordem = dados(checkboxArray[0], enderecofull, enderecofull2);
              nome = dados2(checkboxArray[0], enderecofull, enderecofull2);
              situacao = dados3(checkboxArray[0], enderecofull, enderecofull2);
              if(ordem === undefined){
              	ordem = "Conferir Nota";
              	//alert(ordem);
              }
              if(nome === undefined){
              	nome = "";
              	//alert(ordem);
              }
              if(situacao === undefined){
              	situacao = "";
              	//alert(ordem);
              }
              if(endereco.indexOf("Feira Nova, 8 - Realengo")>-1){
              	ordem = "Destino";
              }
              /*
              if(checkboxArray.indexOf(route.legs[i].end_address) && checkboxArray[i].includes("Entrega")){
              	ordem = 'Entrega';
              	//alert();
              }else if(checkboxArray.indexOf(route.legs[i].end_address) && checkboxArray[i].includes("Retirada")){
              	ordem = 'Retirada';
              	//alert(checkboxArray[i].includes("Retirada"));
              }else if(checkboxArray.indexOf(route.legs[i].end_address) && checkboxArray[i].includes("Destino")){
              	ordem = 'Destino';
              }	
              */
              
              summaryPanel.innerHTML += '<tr><td>'+routeSegment+'</td><td>'+nome+'</td><td>'+endereco.toUpperCase()+'</td><td>'+ordem.toUpperCase()+'</td><td>'+route.legs[i].distance.text+'</td><td>'+situacao.toUpperCase()+'</td></tr>';
              //summaryPanel.innerHTML += '<td>'+route.legs[i].start_address+'</td>';
              //summaryPanel.innerHTML += '<td>'+route.legs[i].end_address+'</td>';
              //summaryPanel.innerHTML += '<td>'+route.legs[i].distance.text+'</td></tr>';
              //summaryPanel.innerHTML += '</tr>';
              //summaryPanel.innerHTML += route.legs[i].start_address + ' até ';
              //summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              //summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
              var str = route.legs[i].distance.text;
              distanciaTotal += parseFloat(str.replace(",","."));
            }
            //alert(distanciaTotal);
            var km = 8;
            var gasolina = 4.79;
            var calculo = parseFloat(distanciaTotal) / parseFloat(km);
            var custo = parseFloat(calculo) * parseFloat(gasolina); 
            //alert(custo.toFixed(2).replace(".",","));
            var strTotal = distanciaTotal.toFixed(2); 
    		var res = strTotal.replace(".", ",");
            //summaryPanel.innerHTML += res+"<br/><strong>Custo Total do roteiro Km</strong> R$ "+custo.toFixed(2).replace(".",",");

            var dataHj = '<?=diadasemana(date("w", strtotime($data))).", ".date("d/m/Y", strtotime($data))?>';
            summaryPanel.innerHTML +='<tr style="background-color:#e5e5e5; border:none"><td style="border:none;"></td><td style="border:none;">DATA: <strong>'+dataHj+'</strong></td><td style="border:none;">CUSTO TOTAL DO ROTEIRO: <strong>R$ '+custo.toFixed(2).replace(".",",")+'</strong></td><td style="border:none;"></td><td style="border:none;">TOTAL: <strong>'+res+' Km</strong></td><td style="border:none;"></td></tr>';
            //summaryPanel.innerHTML +='<tr style="border:0px"><td></td><td><strong>'+dataHj+'</strong></td><td><strong>R$ '+custo.toFixed(2).replace(".",",")+'</strong></td><td></td><td><strong>'+res+' Km</strong></td><td></td></tr>';
            summaryPanel.innerHTML +='<tr style="border:none;"><td style="border:none;"></td><td style="border:none;"></td><td style="border:none;"><strong>RESPONSÁVEL: __________________________________   CONFERENTE: __________________________________</strong></td><td style="border:none;"><strong>HORÁRIO:</strong></td><td style="border:none;">____________</td><td style="border:none;">____________</td></tr>';
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
      function dados(end1 ,end2 , end3){
      	//alert(end1);
      	
      	for(var i = 0; i < end1.length; i++){
      		//alert(i); 	
      		var um = end1[i][1].toLowerCase();
			var dois = end2.toLowerCase();
			var tres = end3[i].end_address.toLowerCase().slice(3, -30);	
			//------Tratando Endereço do SISTEMA
			var sis = um.split("-");
    		var sis2 = sis[0].split(".");
    		var sis3 = sis2.length - 1;
    		//alert(res3);
    		var endSis = sis2[sis3]+" - "+sis[1];	
    		//-------- FIM do Tratamento

			//------Tratando Endereço do Google MAPS
			var res = dois.split("-");
    		var res2 = res[0].split(".");
    		var res3 = res2.length - 1;
    		//alert(res3);
    		var endMaps = res2[res3]+" - "+res[1];	
    		//-------- FIM do Tratamento

				if(endSis.indexOf(endMaps)>-1){
		      		//alert("AXOU Comparando endereços: MAPS -> "+endMaps+" | -- | SISTEMA -> "+endSis+" || "+end1[i][2]);
		      		var destino = end1[i][2];
      			}else if(endMaps.indexOf("feira nova, 8 - realengo")>-1 || endSis.indexOf("feira nova, 8 - realengo")>-1){
      				//alert("AXOU o DESTINO Comparando endereços: MAPS -> "+endMaps+" | -- | SISTEMA -> "+endSis+" || "+end1[i][2]);
      				//alert("Não axou");
      				var destino = "Destino";
      			}else{
      				//alert("NÃO AXOU Comparando endereços: MAPS -> "+endMaps+" | -- | SISTEMA -> "+endSis+" || "+end1[i][2]);
      				//var destino = '';
      			}
				//alert("Comparando endereços: MAPS -> "+end3[o].end_address+" | -- | SISTEMA -> "+um+" || "+end1[i][2]);
				//alert(end3[o].end_address);
				
			
			
			//var o = 0;
			//alert(dois.indexOf(um)+um+dois);
			/*
			if(dois.indexOf(um.toLowerCase())>-1){
	      		//alert(dois.indexOf(um));
	      		//+dois.indexOf(end1[i][1].toLowerCase())
	      		//alert("Comparando endereços: "+dois+" | -- | "+um+" ||"+end1[i][2]);
	      		destino = end1[i][2];
      		}
      		alert("Comparando endereços: MAPS -> "+dois+" | -- | SISTEMA -> "+um+" || "+end1[i][2]);
      		return destino;
	      	*/	      	
      		//if(dois.indexOf(end1[i][1].toLowerCase())){
      			//alert(l+" |-| "+end2.toLowerCase()+" |-| "+end2.indexOf(end1[0]));
      			//+dois.indexOf(end1[i][1].toLowerCase())
      			//alert("Comparando endereços: "+dois+" | -- | "+um);
      		//}
      		
      		/*
      		
	      	*/	 
      	}
      	return destino;
      	//var um = end1.toLowerCase();
      	//var dois = end2.toLowerCase();
      	/*
      	if(dois.indexOf(um)){
      		//alert(l+" |-| "+end2.toLowerCase()+" |-| "+end2.indexOf(end1[0]));
      		alert(dois.indexOf(um));
      	}
      	*/
      }

      function dados2(end1 ,end2 , end3){
      	//alert(end1);
      	
      	for(var i = 0; i < end1.length; i++){
      		//alert(i); 	
      		var um = end1[i][1].toLowerCase();
			var dois = end2.toLowerCase();
			var tres = end3[i].end_address.toLowerCase().slice(3, -30);	
			//------Tratando Endereço do SISTEMA
			var sis = um.split("-");
    		var sis2 = sis[0].split(".");
    		var sis3 = sis2.length - 1;
    		//alert(res3);
    		var endSis = sis2[sis3]+" - "+sis[1];	
    		//-------- FIM do Tratamento

			//------Tratando Endereço do Google MAPS
			var res = dois.split("-");
    		var res2 = res[0].split(".");
    		var res3 = res2.length - 1;
    		//alert(res3);
    		var endMaps = res2[res3]+" - "+res[1];	
    		//-------- FIM do Tratamento

				if(endSis.indexOf(endMaps)>-1){
		      		//alert("AXOU Comparando endereços: MAPS -> "+endMaps+" | -- | SISTEMA -> "+endSis+" || "+end1[i][2]);
		      		var destino = end1[i][0];
      			}else if(endMaps.indexOf("feira nova, 8 - realengo")>-1 || endSis.indexOf("feira nova, 8 - realengo")>-1){
      				//alert("AXOU o DESTINO Comparando endereços: MAPS -> "+endMaps+" | -- | SISTEMA -> "+endSis+" || "+end1[i][2]);
      				//alert("Não axou");
      				var destino = "Destino";
      			}else{
      				//alert("NÃO AXOU Comparando endereços: MAPS -> "+endMaps+" | -- | SISTEMA -> "+endSis+" || "+end1[i][2]);
      				//var destino = '';
      			}
				//alert("Comparando endereços: MAPS -> "+end3[o].end_address+" | -- | SISTEMA -> "+um+" || "+end1[i][2]);
				//alert(end3[o].end_address);
				
			
			
			//var o = 0;
			//alert(dois.indexOf(um)+um+dois);
			/*
			if(dois.indexOf(um.toLowerCase())>-1){
	      		//alert(dois.indexOf(um));
	      		//+dois.indexOf(end1[i][1].toLowerCase())
	      		//alert("Comparando endereços: "+dois+" | -- | "+um+" ||"+end1[i][2]);
	      		destino = end1[i][2];
      		}
      		alert("Comparando endereços: MAPS -> "+dois+" | -- | SISTEMA -> "+um+" || "+end1[i][2]);
      		return destino;
	      	*/	      	
      		//if(dois.indexOf(end1[i][1].toLowerCase())){
      			//alert(l+" |-| "+end2.toLowerCase()+" |-| "+end2.indexOf(end1[0]));
      			//+dois.indexOf(end1[i][1].toLowerCase())
      			//alert("Comparando endereços: "+dois+" | -- | "+um);
      		//}
      		
      		/*
      		
	      	*/	 
      	}
      	return destino;
      	//var um = end1.toLowerCase();
      	//var dois = end2.toLowerCase();
      	/*
      	if(dois.indexOf(um)){
      		//alert(l+" |-| "+end2.toLowerCase()+" |-| "+end2.indexOf(end1[0]));
      		alert(dois.indexOf(um));
      	}
      	*/
      }
      function dados3(end1 ,end2 , end3){
      	//alert(end1);
      	
      	for(var i = 0; i < end1.length; i++){
      		//alert(i); 	
      		var um = end1[i][1].toLowerCase();
			var dois = end2.toLowerCase();
			var tres = end3[i].end_address.toLowerCase().slice(3, -30);	
			//------Tratando Endereço do SISTEMA
			var sis = um.split("-");
    		var sis2 = sis[0].split(".");
    		var sis3 = sis2.length - 1;
    		//alert(res3);
    		var endSis = sis2[sis3]+" - "+sis[1];	
    		//-------- FIM do Tratamento

			//------Tratando Endereço do Google MAPS
			var res = dois.split("-");
    		var res2 = res[0].split(".");
    		var res3 = res2.length - 1;
    		//alert(res3);
    		var endMaps = res2[res3]+" - "+res[1];	
    		//-------- FIM do Tratamento

				if(endSis.indexOf(endMaps)>-1){
		      		//alert("AXOU Comparando endereços: MAPS -> "+endMaps+" | -- | SISTEMA -> "+endSis+" || "+end1[i][2]);
		      		var destino = end1[i][3];
      			}else if(endMaps.indexOf("feira nova, 8 - realengo")>-1 || endSis.indexOf("feira nova, 8 - realengo")>-1){
      				//alert("AXOU o DESTINO Comparando endereços: MAPS -> "+endMaps+" | -- | SISTEMA -> "+endSis+" || "+end1[i][2]);
      				//alert("Não axou");
      				var destino = "";
      			}else{
      				//alert("NÃO AXOU Comparando endereços: MAPS -> "+endMaps+" | -- | SISTEMA -> "+endSis+" || "+end1[i][2]);
      				//var destino = '';
      			}
				//alert("Comparando endereços: MAPS -> "+end3[o].end_address+" | -- | SISTEMA -> "+um+" || "+end1[i][2]);
				//alert(end3[o].end_address);
				
			
			
			//var o = 0;
			//alert(dois.indexOf(um)+um+dois);
			/*
			if(dois.indexOf(um.toLowerCase())>-1){
	      		//alert(dois.indexOf(um));
	      		//+dois.indexOf(end1[i][1].toLowerCase())
	      		//alert("Comparando endereços: "+dois+" | -- | "+um+" ||"+end1[i][2]);
	      		destino = end1[i][2];
      		}
      		alert("Comparando endereços: MAPS -> "+dois+" | -- | SISTEMA -> "+um+" || "+end1[i][2]);
      		return destino;
	      	*/	      	
      		//if(dois.indexOf(end1[i][1].toLowerCase())){
      			//alert(l+" |-| "+end2.toLowerCase()+" |-| "+end2.indexOf(end1[0]));
      			//+dois.indexOf(end1[i][1].toLowerCase())
      			//alert("Comparando endereços: "+dois+" | -- | "+um);
      		//}
      		
      		/*
      		
	      	*/	 
      	}
      	return destino;
      	//var um = end1.toLowerCase();
      	//var dois = end2.toLowerCase();
      	/*
      	if(dois.indexOf(um)){
      		//alert(l+" |-| "+end2.toLowerCase()+" |-| "+end2.indexOf(end1[0]));
      		alert(dois.indexOf(um));
      	}
      	*/
      }
    </script>
    
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap&language=pt&region=BR">
    </script>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      
  </body>
</html>