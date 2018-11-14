<?php    
    include "conexao.php";
    $valor = $_POST['valor'];
    $entrega = $_POST['entrega'];
    $retirada = $_POST['retirada'];
    $dias = datadiff(dtentrada($_POST["entrega"]),dtentrada($_POST["retirada"]));
    if($dias<=8){
       $valorTotal = $valor; 
    }elseif($dias>8 AND $dias<=16){               
       $pctm = "30.00"; 
       $valorTotal = $valor + ($valor / 100 * $pctm);
    }elseif($dias>16 AND $dias<=31){
       $pctm = "60.00"; 
       $valorTotal = $valor + ($valor / 100 * $pctm);
    }elseif($dias>32){
       $pctm = "90.00"; 
       $valorTotal = $valor + ($valor / 100 * $pctm);
    }
    $arrayValorTotal = array();
    $arrayValorTotal["valor"]  = $valorTotal;
    $arrayValorTotal["dias"] = $dias;  
    echo json_encode($arrayValorTotal);
?>