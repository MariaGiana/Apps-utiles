<?php
function sumar($n1,$n2){
    $resultado=$n1+$n2;
}
function restar($n1,$n2){
    $resultado=$n1-$n2;
}
function multiplicar($n1,$n2){
    $resultado=$n1*$n2;
}
function dividir($n1,$n2){
    if($n2==0){
        echo("no se puede dividir por 0");
    }
    else{
    $resultado=$n1/$n2;
}
}
?>