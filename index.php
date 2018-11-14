<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="fonts/roboto/" rel="stylesheet">
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">  
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <script src="https://www.gstatic.com/firebasejs/5.5.5/firebase.js"></script>
      <script src="js/firebase.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
      <style>
      td {
          font-size: 12px;
      }
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
    </style>
    </head>
    <body>
    <?php include"navbar.php"; ?>  
    <div class="container-fluid">
      <div class="row col s12 m12 l12">
        <div class="col s12 m12 l6">
          <?php include "modules/entregas.php"; ?>
          <?php include "modules/bairros.php"; ?>
        </div>
        <div class="col s12 m12 l6">
          <?php include "modules/busca-cliente.php";?>
          <?php include "modules/valor-total.php"; ?>  
        </div>
        <div class="col s12 m12 l6">
          <?php include "modules/historico-valores.php"; ?>
          <?php //include "modules/historico-locacao.php"; ?>
        </div>
        <div class="col s12 m12 l6">
          <?php include "modules/pagamentos.php"; ?>
          <?php include "modules/vendedor.php"; ?>
          <?php include "modules/geral-cidades.php"; ?>
          <?php include "modules/maps.php"; ?>    
        </div>  
      </div> 
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="http://www.position-absolute.com/creation/print/jquery.printPage.js" type="text/javascript"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $(".btnPrint").printPage();
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
                limit: 3, // The max amount of results that can be shown at once. Default: Infinity.
              }).on('change', function name(argumento) {
                $.ajax({
                  dataType: "json",
                  data: {cliente: this.value},
                  method: "POST", 
                  url: 'ajax-teste-cliente-unico.php',
                  success: function(response2) {
                    window.location.replace("vizualiza-dados.php?id="+response2[0].id);
                  }  
                });       
              });    
            }
          });
        });
      </script> 
      </div>
    </body>
  </html>