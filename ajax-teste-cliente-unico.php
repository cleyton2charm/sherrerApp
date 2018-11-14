<?php    
    include "conexao.php";
    $cliente = $_POST['cliente'];
    $array = array();
    //$sel = "SELECT DISTINCT * FROM locacao WHERE nome = '".$cliente."'";
    $sel = "SELECT * FROM locacao WHERE nome = '$cliente' GROUP BY id ORDER BY MAX(id) DESC";
    $qry = mysqli_query($connection, $sel);
    if(mysqli_num_rows($qry)>0){               
        while ($key = mysqli_fetch_assoc($qry)){
                array_push($array, array('id'=>$key["id"], 'nome'=>utf8_encode($key["nome"]), 'email'=>$key["email"], 'registro'=>$key['registro'], 'ddd'=>$key['ddd'], 'ddd2'=>$key['ddd2'], 'telefone'=>$key['telefone'], 'telefone2'=>$key['telefone2'], 'endereco'=>$key['endereco']));              
        }
        echo json_encode($array);
    }   
    //, 
?>