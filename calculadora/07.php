<?php
require_once('operaciones.php');

if(!is_numeric($_GET['numero1'])||!is_numeric($_GET['numero2'])|| empty('operador')){
   
    echo("Ingrese parametros correctos!!");
}else{
$numero1=$_GET['numero1'];
$numero2=$_GET['numero2'];
$operacion=$_GET['operacion'];
$resultado=0;

/*
OPCION CON IF
if($operacion=="sumar"){
    $resultado=$numero1+$numero2;
}
else if($operacion=="retar"){
    $resultado=$numero1-$numero2;
}
else if($operacion=="multiplicar"){
    $resultado=$numero1*$numero2;
}
else if($operacion=="dividir"){
    $resultado=$numero1/$numero2;
    echo($resultado);
}
echo("El resultado es: ".$resultado);
}*/

/*OPCION CON SWITCH
switch($operacion){
    case'sumar':{
        $resultado=$numero1+$numero2;
        break;
    };
    case'restar':{
        $resultado=$numero1-$numero2;
        break;
    };
    case'multiplicar':{
        $resultado=$numero1*$numero2;
        break;
    }
    case'dividir':{
        $resultado=$numero1/$numero2;
        break;
    }
    
}
echo("El resultado es:".$resultado."   ");
}*/


switch($operacion){
    case'sumar':{
        $resultado=sumar($numero1,$numero2);
        break;
    };
    case'restar':{
        $resultado=restar($numero1,$numero2);
        break;
    };
    case'multiplicar':{
        $resultado=multiplicar($numero1,$numero2);
        break;
    }
    case'dividir':{
        if($numero2!=0){
        $resultado=dividir($numero1,$numero2);
       
    }else echo ("ingrese otro numero");
    break;
}
echo("El resultado es:".$resultado."   ");
}
    }
?>
<a href="ejercicio7.html">VOLVER</a>