<script>
    function initApp() {
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          var displayName = user.displayName;
          var email = user.email;
          var emailVerified = user.emailVerified;
          var photoURL = user.photoURL;
          var isAnonymous = user.isAnonymous;
          var uid = user.uid;
          var providerData = user.providerData;
          console.log("Logado como: "+email+photoURL+displayName);
          if(email=="tom.soarez@gmail.com" && photoURL==null){
            photoURL = "https://lh3.googleusercontent.com/-Wv_IwBeSQLA/AAAAAAAAAAI/AAAAAAAAAAA/AGDgw-icBf9f56Q6aDETIeBIYS0V743Vig/s32-c-mo/photo.jpg";
            displayName = "Clayton Soares";
          }
          if(email=="sherrer.ms@gmail.com" && photoURL==null){
            photoURL = "https://lh3.googleusercontent.com/-ASCMFPd--2w/AAAAAAAAAAI/AAAAAAAAAAA/AGDgw-hg_ZU9fAdagtqWePDpb87yF54meg/s64-c-mo/photo.jpg";
            displayName = "Sherrer Montagens";
          }
          document.getElementById("imguser").src = photoURL;
          document.getElementById("nameuser").innerHTML = displayName;
          document.getElementById("emailuser").innerHTML = email;
          document.getElementById("sidenavimguser").src = photoURL;
          document.getElementById("sidenavnameuser").innerHTML = displayName;
          document.getElementById("sidenavemailuser").innerHTML = email;
        } else {
          window.location = "login.php";
        }
      });
    }
    window.onload = function() {
      initApp();
    };

    // Logout
    /*
    var logOutButton = document.getElementById('logOutButton');
    logOutButton.addEventListener('click', function () {
      firebase
        .auth()
        .signOut()
        .then(function () {
            window.location = "login.php";
            //displayName.innerText = 'Você não está autenticado';
            //alert('Você se deslogou');
        }, function (error) {
            console.error(error);
            //alert(error);
        });
    });
    */
    function logout(){
        firebase.auth().signOut().then(function() {
            window.location = "login.php";        
            // Sign-out successful.
        }).catch(function(error) {
            console.error(error);
            // An error happened.
        });
    }
</script>
<?php
include "conexao.php";
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_MONETARY, "pt_BR", "ptb");
//$variavelphp = "<script>document.write(email)</script>";
?>
<div id="topo" class="conteiner-fluid">
  <nav>
    <div class="nav-wrapper">
      <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
      <a href="index.php" class="brand-logo">Sherrer App</a>
      <ul class="right hide-on-med-and-down">
        <li>
          <?php
          $select0 = "SELECT * FROM locacao WHERE retirada < '".date("Y-m-d 00:00:00")."'  AND status NOT IN (4,9,12) ORDER BY retirada";
          $conecta0 = mysqli_query($connection, $select0);
          if(mysqli_num_rows($conecta0)>0){
            $locacoesInativas = mysqli_num_rows($conecta0);
          ?>
          <a class='dropdown-button btn-floating pulse red darken-2' href='#' data-activates='dropdownmenu'><i class="material-icons right">filter_<?=$locacoesInativas?></i></a>
          <!-- Dropdown Structure -->
          <ul id='dropdownmenu' class='dropdown-content'>
            <?php
            while($row0 = mysqli_fetch_assoc($conecta0)) {
            ?>  
            <li>
            <a class="tooltipped" data-position="left" data-delay="50" data-tooltip="Nº (<?=$row0["id"]?>) não retornou dia: <?=date("d/m/Y", strtotime($row0["retirada"]))." ".diadasemana(date("w", strtotime($row0["retirada"])))?>" href='vizualiza-dados.php?id=<?=$row0["id"]?>'>COMPROVANTE Nº <?=$row0["id"]?></a>
            </li>          
            <?php
              }
            ?>
          </ul>
          <?php
            }
          ?>
        </li>
        <li><a href="gerar-romaneio.php" class="btn-floating tooltipped" data-position="bottom" data-tooltip="Gerar Romaneio"><i class="material-icons">directions</i></a>
        <li><a href="cadastro-cliente.php" class="btn-floating tooltipped" data-position="bottom" data-tooltip="Cliente Novo"><i class="material-icons">person_add</i></a>
        </li>
        <li>
          <a href="#!" style="padding-top: 5px" class="dropdown-button btn-floating transparent z-depth-0" data-activates="dropdownuser"><img id="imguser" src="img/logo.png" class="circle responsive-img"></a>
          <ul id='dropdownuser' class='dropdown-content'>      
              <li>
                  <a><i class="material-icons">person</i><span id="nameuser"></span></a>
              </li>
              <li>
                  <a><i class="material-icons">email</i><span id="emailuser"></span></a>
              </li>
              <li>
                  <a onclick="logout()"><i class="material-icons">exit_to_app</i> sair</a>
              </li>    
          </ul>
        </li>
      </ul>
      <ul id="slide-out" class="side-nav">
        <li><div class="user-view">
            <div class="background">
              <!--<img src="http://archives.materializecss.com/0.100.2/images/office.jpg">-->
              <img src="https://aphoenicopterus.files.wordpress.com/2012/10/perfil-do-rio-de-janeiro.jpg" />

            </div>
            <a href="#!user"><img id="sidenavimguser" class="circle" src="img/logo.png"></a>
            <a href="#!name"><span id="sidenavnameuser" class="white-text name"></span></a>
            <a href="#!email"><span id="sidenavemailuser" class="white-text email"></span></a>
          </div></li>
          <li><a href="cadastro-cliente.php"><i class="material-icons">person_add</i>Cliente Novo</a></li>
          <li><a href="gerar-romaneio.php"><i class="material-icons">directions</i>Gerar Romaneio</a></li>
          <li><a class="waves-effect" href="busca-cliente.php"><i class="material-icons">search</i>Busca Avançada</a></li>
          <li><a href="locacoes-ativas.php"><i class="material-icons">list_alt</i>Locações Ativas</a></li>
          <li><div class="divider"></div></li>
          <li><a href="#!" onclick="logout()"><i class="material-icons">exit_to_app</i>Sair do App</a></li>
        </ul>
        <!--
        <li><a href="gerar-romaneio.php" target="_blank">Gerar Romaneio </a></li>
        <li><a href="busca-cliente.php">Buscar Avançada</a></li>
        <li><a href="cadastro-cliente.php" class="btn-large"><i class="material-icons">person_add</i></a></li>
      -->
      </ul>
    </div>
  </nav>
</div>
