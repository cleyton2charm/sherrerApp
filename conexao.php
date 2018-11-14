<?php
$connection = mysqli_connect('localhost', 'sherrerc', '9865ejVrDe', 'sherrerc_producao');
function dtentrada($entrada){
  $dia = $entrada[0].$entrada[1];
	$ano = substr($entrada,-4);
	$mes = explode(",", substr($entrada,2)); 
	$atual = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
  $outra = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	$s = str_replace($atual, $outra, trim($mes[0]));
	return $date = date("Y-m-d" ,strtotime(trim($s)." ".trim($dia).", ".trim($ano)));
	//return trim($s)." ".trim($dia[0]).", ".trim($mesArray[1]);
}
function dtsaida($saida){
    $outra = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    $atual = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
    $explode = explode("-", $saida);
    $s = str_replace($atual, $outra, $explode[1]);
    return $data = $explode[2]." ".$s.",".$explode[0];
}
function datadiff($entrada,$saida){
  $data_inicial = $entrada;
  $data_final = $saida;
  $time_inicial = strtotime($data_inicial);
  $time_final = strtotime($data_final);
  $diferenca = $time_final - $time_inicial;
  $dias = (int)floor( $diferenca / (60 * 60 * 24));
  $dias-1;
  if($dias==0){
    $dias=1;
  }
  return $dias;
}
function forma_pgto($pgto){
  $arrayPgto = array(1=>"DINHEIRO", 2=>"CARTÃO", 3=>"DEPÓSITO", 4=>"CHEQUE");
  return $arrayPgto[$pgto];
}
function vendedor($vendedor){
  $arrayVendedor = array(1=>"CLAYTON SOARES", 2=>"SANDRA LESSA", 3=>"ANTÔNIO SERGIO", 4=>"VINÍCIUS SOARES");
  return $arrayVendedor[$vendedor];
}
function situacao($situacao){
  $arraySituacao = array(1=>"À PAGAR", 2=>"PAGO", 3=>"PAGO PARCIALMENTE", 4=>"CANCELADO", 5=>"PAGAMENTO NA RETIRADA");
  return $arraySituacao[$situacao];
}
function status($status){
  $arrayStatus = array(0=>"ENTREGA AGENDADA", 1=>"SAIU PARA ENTREGA", 2=>"ENTREGA EM ANDAMENTO", 3=>"ENTREGA EFETUADA", 4=>"PEDIDO CANCELADO", 5=>"ENTREGA NÃO EFETUADA", 6=>"RETIRADA AGENDADA", 7=>"SAIU PARA RETIRADA", 8=>"RETIRADA EM ANDAMENTO", 9=>"MATERIAL RECOLHIDO", 10=>"RETIRADA CANCELADA", 11=>"RETIRADA NÃO EFETUADA", 12=>"PEDIDO RENOVADO");
  return $arrayStatus[$status];
}
function diadasemana($dia){
  $arrayDiaSemana = array('DOMINGO', 'SEGUNDA', 'TERÇA', 'QUARTA', 'QUINTA', 'SEXTA', 'SÁBADO');
  return $arrayDiaSemana[$dia];
}
function moedaReal($moeda){
  $retorno = strtr($moeda, "." , ",");
  return $retorno;
}
function formatar ($tipo, $string, $size)
{
    $string = @preg_replace("[^0-9]", "", $string);
    
    switch ($tipo)
    {
        case 'fone':
            if($size === 8){
             $string = substr($string, 0, 4) 
             . '-' . substr($string, 4);
         }else
         if($size === 9){
             $string = substr($string, 0, 5) 
             . '-' . substr($string, 5);
         }
         break;
        case 'cep':
            $string = substr($string, 0, 5) . '-' . substr($string, 5, 3);
         break;
        case 'cpf':
            $string = substr($string, 0, 3) . '.' . substr($string, 3, 3) . 
                '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
         break;
        case 'cnpj':
            $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) . 
                '.' . substr($string, 5, 3) . '/' . 
                substr($string, 8, 4) . '-' . substr($string, 12, 2);
         break;
        case 'rg':
            $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) . 
                '.' . substr($string, 5, 3);
         break;
        default:
         $string = 'É ncessário definir um tipo(fone, cep, cpg, cnpj, rg)';
    }
    return $string;
}

function my_money_format($valor, $formato = '%n') {
    
        if (function_exists('money_format')) {
    
            // Comente a linha abaixo caso possua a funcao money_format
            return money_format($formato, $valor);
        }
    
        $locale = localeconv();
    
        // Extraindo opcoes do formato
        $regex = '/^'.             // Inicio da Expressao
                 '%'.              // Caractere %
                 '(?:'.            // Inicio das Flags opcionais
                 '\=([\w\040])'.   // Flag =f
                 '|'.
                 '([\^])'.         // Flag ^
                 '|'.
                 '(\+|\()'.        // Flag + ou (
                 '|'.
                 '(!)'.            // Flag !
                 '|'.
                 '(-)'.            // Flag -
                 ')*'.             // Fim das flags opcionais
                 '(?:([\d]+)?)'.   // W  Largura de campos
                 '(?:#([\d]+))?'.  // #n Precisao esquerda
                 '(?:\.([\d]+))?'. // .p Precisao direita
                 '([in%])'.        // Caractere de conversao
                 '$/';             // Fim da Expressao
    
        if (!preg_match($regex, $formato, $matches)) {
            trigger_error('Formato invalido: '.$formato, E_USER_WARNING);
            return $valor;
        }
    
        // Recolhendo opcoes do formato
        $opcoes = array(
            'preenchimento'   => ($matches[1] !== '') ? $matches[1] : ' ',
            'nao_agrupar'     => ($matches[2] == '^'),
            'usar_sinal'      => ($matches[3] == '+'),
            'usar_parenteses' => ($matches[3] == '('),
            'ignorar_simbolo' => ($matches[4] == '!'),
            'alinhamento_esq' => ($matches[5] == '-'),
            'largura_campo'   => ($matches[6] !== '') ? (int)$matches[6] : 0,
            'precisao_esq'    => ($matches[7] !== '') ? (int)$matches[7] : false,
            'precisao_dir'    => ($matches[8] !== '') ? (int)$matches[8] : $locale['int_frac_digits'],
            'conversao'       => $matches[9]
        );
    
        // Sobrescrever $locale
        if ($opcoes['usar_sinal'] && $locale['n_sign_posn'] == 0) {
            $locale['n_sign_posn'] = 1;
        } elseif ($opcoes['usar_parenteses']) {
            $locale['n_sign_posn'] = 0;
        }
        if ($opcoes['precisao_dir']) {
            $locale['frac_digits'] = $opcoes['precisao_dir'];
        }
        if ($opcoes['nao_agrupar']) {
            $locale['mon_thousands_sep'] = '';
        }
    
        // Processar formatacao
        $tipo_sinal = $valor >= 0 ? 'p' : 'n';
        if ($opcoes['ignorar_simbolo']) {
            $simbolo = '';
        } else {
            $simbolo = $opcoes['conversao'] == 'n' ? $locale['currency_symbol']
                                                   : $locale['int_curr_symbol'];
        }
        $numero = number_format(abs($valor), $locale['frac_digits'], $locale['mon_decimal_point'], $locale['mon_thousands_sep']);
    
    /*
    //TODO: dar suporte a todas as flags
        list($inteiro, $fracao) = explode($locale['mon_decimal_point'], $numero);
        $tam_inteiro = strlen($inteiro);
        if ($opcoes['precisao_esq'] && $tam_inteiro < $opcoes['precisao_esq']) {
            $alinhamento = $opcoes['alinhamento_esq'] ? STR_PAD_RIGHT : STR_PAD_LEFT;
            $numero = str_pad($inteiro, $opcoes['precisao_esq'] - $tam_inteiro, $opcoes['preenchimento'], $alinhamento).
                      $locale['mon_decimal_point'].
                      $fracao;
        }
    */
    
        $sinal = $valor >= 0 ? $locale['positive_sign'] : $locale['negative_sign'];
        $simbolo_antes = $locale[$tipo_sinal.'_cs_precedes'];
    
        // Espaco entre o simbolo e o numero
        $espaco1 = $locale[$tipo_sinal.'_sep_by_space'] == 1 ? ' ' : '';
    
        // Espaco entre o simbolo e o sinal
        $espaco2 = $locale[$tipo_sinal.'_sep_by_space'] == 2 ? ' ' : '';
    
        $formatado = '';
        switch ($locale[$tipo_sinal.'_sign_posn']) {
        case 0:
            if ($simbolo_antes) {
                $formatado = '('.$simbolo.$espaco1.$numero.')';
            } else {
                $formatado = '('.$numero.$espaco1.$simbolo.')';
            }
            break;
        case 1:
            if ($simbolo_antes) {
                $formatado = $sinal.$espaco2.$simbolo.$espaco1.$numero;
            } else {
                $formatado = $sinal.$numero.$espaco1.$simbolo;
            }
            break;
        case 2:
            if ($simbolo_antes) {
                $formatado = $simbolo.$espaco1.$numero.$sinal;
            } else {
                $formatado = $numero.$espaco1.$simbolo.$espaco2.$sinal;
            }
            break;
        case 3:
            if ($simbolo_antes) {
                $formatado = $sinal.$espaco2.$simbolo.$espaco1.$numero;
            } else {
                $formatado = $numero.$espaco1.$sinal.$espaco2.$simbolo;
            }
            break;
        case 4:
            if ($simbolo_antes) {
                $formatado = $simbolo.$espaco2.$sinal.$espaco1.$numero;
            } else {
                $formatado = $numero.$espaco1.$simbolo.$espaco2.$sinal;
            }
            break;
        }
    
        // Se a string nao tem o tamanho minimo
        if ($opcoes['largura_campo'] > 0 && strlen($formatado) < $opcoes['largura_campo']) {
            $alinhamento = $opcoes['alinhamento_esq'] ? STR_PAD_RIGHT : STR_PAD_LEFT;
            $formatado = str_pad($formatado, $opcoes['largura_campo'], $opcoes['preenchimento'], $alinhamento);
        }
    
        return $formatado;
    }
?>