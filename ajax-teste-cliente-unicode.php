<?php    
    include "conexao.php";
    //$array = array();
    //$sel = "SELECT DISTINCT * FROM locacao WHERE nome = '".$cliente."'";
    $sel = "SELECT * FROM locacao";
    $qry = mysqli_query($connection, $sel);
    if(mysqli_num_rows($qry)>0){               
        while ($key = mysqli_fetch_assoc($qry)){
            $id = $key["id"];
            $nome = utf8_decode($key["nome"]);
            $endereco = utf8_decode($key["endereco"]);
            $material = utf8_decode($key["material"]);
            $obs = utf8_decode($key["obs"]);
            echo utf8_decode($key["nome"])." - ";
            echo utf8_decode($key["endereco"])." - ";              
            echo utf8_decode($key["material"])."<br/><br/>";
            $update = "UPDATE locacao SET nome = '".$nome."', endereco = '".$endereco."', material = '".$material."', obs = '".$obs."' WHERE id = ".$id;
      $conecta = mysqli_query($connection, $update);
        }
       //echo json_encode($array);
    }   
    //, 
?>