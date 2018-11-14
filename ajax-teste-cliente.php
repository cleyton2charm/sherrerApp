<?php    
    include "conexao.php";
    /*
    $res = [];
    $sql = "SELECT `nome`,`endereco` FROM `locacao`";
    $qry = mysqli_query($connection, $sql);
    while ($key = mysqli_fetch_row($qry)){
        $res[] = $key[0];
    }
    echo json_encode($res);
    */
    $array = array();
    //$sel = "SELECT nome FROM locacao GROUP BY id ORDER BY MAX(id)";
    $sel = "SELECT DISTINCT nome FROM locacao";
    $qry = mysqli_query($connection, $sel);
    if(mysqli_num_rows($qry)>0){               
        while ($key = mysqli_fetch_row($qry)){
            array_push($array, array('id'=>$key[0], 'nome'=>$key[0]));
        }
        echo json_encode($array);
    }   
?>