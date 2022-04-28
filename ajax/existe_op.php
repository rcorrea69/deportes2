<?php 
require_once ("../include/validar_session.php");
require_once("../conexion.php");

$op=$_POST["op"];


$sql="SELECT * FROM o_pagos WHERE id_op=$op";
//die($sql);
$res=mysqli_query($link, $sql);

            if(mysqli_num_rows($res) > 0){
                $res=1;
            }else{
                $res=0;
            }
    
    echo $res;    
    mysqli_close($link);


?>