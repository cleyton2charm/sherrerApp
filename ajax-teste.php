<?php    
    include "conexao.php";
    $tabela = $_POST['tabela'];
    $quantidade = $_POST['quantidade'];
    //$entrega = $_POST['entrega'];
    //$retirada = $_POST['retirada'];
    //$dias = datadiff(dtentrada($_POST["entrega"]),dtentrada($_POST["retirada"]));
    $array = array();
    $sel = "SELECT * FROM ".$tabela;
    $qry = mysqli_query($connection, $sel);
    if(mysqli_num_rows($qry)>0){               
        while ($key = mysqli_fetch_row($qry)){
            switch($tabela){
                case 'andaime1x1';
                $linha = array('metros' => $key[0], 'andaimes' => ($key[1]*$quantidade), 'travessas' => ($key[2]*$quantidade), 'diagonais' => ($key[3]*$quantidade), 'sapatas' => ($key[4]*$quantidade), 'rodinhas' => ($key[5]*$quantidade), 'plataformas' => ($key[6]*$quantidade), 'valor' => ($key[7]*$quantidade));
                break;
                case 'andaimes150x150';
                $linha = array('metros' => $key[0], 'andaimes' => ($key[1]*$quantidade), 'tesouras' => ($key[2]*$quantidade), 'sapatas' => ($key[3]*$quantidade), 'rodinhas' => ($key[4]*$quantidade), 'plataformas' => ($key[5]*$quantidade), 'valor' => ($key[6]*$quantidade));    
                break;
                case 'andaimes150x100';
                $linha = array('metros' => $key[0], 'andaimes' => ($key[1]*$quantidade), 'sapatas' => ($key[2]*$quantidade), 'rodinhas' => ($key[3]*$quantidade), 'plataformas' => ($key[4]*$quantidade), 'valor' => ($key[5]*$quantidade));
            }             
            array_push($array, $linha);
        }
        echo json_encode($array);
    }
?>