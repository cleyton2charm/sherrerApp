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
    //$array = array();
    //$sel = "SELECT nome FROM locacao GROUP BY id ORDER BY MAX(id)";
    $sel = "SELECT * FROM locacao";
    $qry = mysqli_query($connection, $sel);
    if(mysqli_num_rows($qry)>0){               
        while ($key = mysqli_fetch_row($qry)){
            echo $key[0]." - ";
            echo $key[1]." - ";
            echo $key[8]." - ";
            echo $key[9]." - ";
            echo $key[15]."<br/>";
            /*
            $insert = "UPDATE locacao SET nome = '".utf8_decode($key[1])."', endereco = '".utf8_decode($key[8])."', material = '".utf8_decode($key[9])."', obs = '".utf8_decode($key[15])."' WHERE id = ".$key[0];
            $conecta = mysqli_query($connection, $insert);
            if($conecta){
                echo $key[0]." Sim <br/>";
            }else{
                echo $key[0]." Não <br/>";
            } 
            */
        }
        //echo json_encode($array);
    }   
?>