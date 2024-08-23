<?php
function sumar($n1,$n2){
    return $n1+$n2;
}
function restar($n1,$n2){
    return $n1-$n2;
}
function multiplicar($n1,$n2){
    return $n1*$n2;
}
function dividir($n1,$n2){
    if($n2==0){
        echo("no se puede dividir por 0");
        return null; 
    }
    else{
    return $n1/$n2;
}
}
?>