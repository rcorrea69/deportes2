<?php include('../fpdf/fpdf.php');

include('../conexion.php');

function formato_fecha_dd_mm_Y($date)
{   
    $fecha = str_replace('/', '-', $date);
    return date('d/m/Y', strtotime($date));
}

function formato_fecha_Y_mm_dd($date)
{   
    $fecha = str_replace('/', '-', $date);
    return date('Y-m-d', strtotime($fecha));
}   

$op=$_GET['op'];


$sqlcabecera="SELECT socios.dni,socios.apellidos,socios.nombres,categorias.ca_nombre,o_pagos.op_fecha,o_pagos.op_importe FROM socios,categorias,o_pagos Where socios.id_categoria=categorias.id_categoria AND o_pagos.socio=socios.dni and o_pagos.id_op=".$op;


//die($sqlcabecera);

$res = mysqli_query($link, $sqlcabecera);
 while($row=mysqli_fetch_array($res)){

        $dni=$row['dni'];
        $nombre=$row['nombres'];
        $apellido=$row['apellidos'];
        $categoria=$row['ca_nombre'];
        $fecha=$row['op_fecha'];
 }


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../img/derecho.png',10,5,95);
 

    $this->SetFont('Times','I',15);

    $this->Cell(100);
    $this->Cell(95,10,utf8_decode('Dirección de Deportes'),0,0,'C');
    // Salto de línea
    $this->Ln(20);
}


}

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm','Legal');
//$pdf->AliasNbPages();
$pdf->AddPage();



$pdf->SetFont('Times','',12);
//$pdf->Cell(0);
$pdf->Cell(15,7, utf8_decode('D.N.I:'),0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(30,7, utf8_decode($dni),0,0,'L'); 
$pdf->Cell(70,7, utf8_decode($apellido." ".$nombre),0,1,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(45,7, utf8_decode('Categoría:'),0,0,'L');
//$pdf->Cell(20,7, utf8_decode('Categoría:'),0,0,'L'); 
$pdf->SetFont('Times','B',12);
$pdf->Cell(70,7, utf8_decode($categoria),0,1,'L'); 
//$pdf->ln(3);
$pdf->SetFont('Times','',12);
//$pdf->Cell(5);
$pdf->SetFont('Helvetica','B',15);

$pdf->Cell(160,10, utf8_decode('OP: '.$op),0,0,'R');
$pdf->Cell(35,10, utf8_decode(formato_fecha_dd_mm_Y($fecha)),0,1,'R');


$pdf->SetFont('Times','B',15);
//$pdf->Cell(5);
$pdf->Cell(195,8, utf8_decode('Detalle de Pagos'),1,1,'C');
$pdf->SetFont('Arial','I',13);
//$pdf->Cell(30,5, utf8_decode('DNI'),1,0,'C');
$pdf->Cell(25,8, utf8_decode('Código'),1,0,'C');
$pdf->Cell(90,8, utf8_decode('Concepto'),1,0,'C');
//$pdf->Cell(30,5, utf8_decode('Categoría'),1,0,'C');
$pdf->Cell(25,8, utf8_decode('Período'),1,0,'C');
$pdf->Cell(20,8, utf8_decode('Desc.'),1,0,'C');
$pdf->Cell(35,8, utf8_decode('Importe'),1,1,'C');


///// estos son los ejemplos//////////////

$sqldetalle="SELECT * FROM op_detalles WHERE id_op=".$op;
$res=mysqli_query($link,$sqldetalle);
$total=0;
while($fila=mysqli_fetch_array($res)){
    
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(25,7, utf8_decode($fila['id_codigo']),1,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(90,7, utf8_decode($fila['detalle_codigo']),1,0,'L');
    $pdf->Cell(25,7, utf8_decode($fila['periodo']),1,0,'C');
    $pdf->Cell(20,7, utf8_decode($fila['descuento']),1,0,'C');
    $pdf->Cell(35,7, utf8_decode("$ ".$fila['importe']),1,1,'C');
    $total=$total+$fila['importe'];


}


//////////total//////////////////////////////////////
$pdf->SetFont('Arial','B',14);
$pdf->Cell(160,7, utf8_decode('TOTAL'),1,0,'R');
$pdf->Cell(35,7, utf8_decode("$ ".number_format($total,2,',','.')),1,1,'R');





// $pdf->Cell(40,8, utf8_decode('esto es y  '.$y_aqui),1,1,'C');
// $pdf->Cell(40,8, utf8_decode('esto es x  '.$x_aqui),1,1,'C');


////////////////////////////////constancia para control ///////////////////////////
$pdf->SetXY(10,120);
$pdf->SetFont('Times','',12);
$pdf->Cell(15,7, utf8_decode('D.N.I:'),0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(30,7, utf8_decode($dni),0,0,'L'); 
$pdf->Cell(80,7, utf8_decode($apellido." ".$nombre),0,0,'L');

$pdf->SetFont('Helvetica','B',15);

$pdf->Cell(35,7, utf8_decode('OP: '.$op),0,0,'L');
$pdf->Cell(35,7, utf8_decode(formato_fecha_dd_mm_Y($fecha)),0,1,'R');
$pdf->SetFont('Times','',12);
$pdf->Cell(45,7, utf8_decode('Categoría:'),0,0,'L');
//$pdf->Cell(20,7, utf8_decode('Categoría:'),0,0,'L'); 
$pdf->SetFont('Times','B',12);
$pdf->Cell(70,7, utf8_decode($categoria),0,0,'L'); 
$pdf->Cell(80,7, utf8_decode('Constancia Para Control'),0,1,'R');
//$pdf->ln(3);
$pdf->SetFont('Times','',12);
//$pdf->Cell(5);


$pdf->SetFont('Times','B',15);
//$pdf->Cell(5);
$pdf->Cell(195,8, utf8_decode('Detalle de Pagos'),1,1,'C');
$pdf->SetFont('Arial','I',13);
//$pdf->Cell(30,5, utf8_decode('DNI'),1,0,'C');
$pdf->Cell(25,8, utf8_decode('Código'),1,0,'C');
$pdf->Cell(90,8, utf8_decode('Concepto'),1,0,'C');
//$pdf->Cell(30,5, utf8_decode('Categoría'),1,0,'C');
$pdf->Cell(25,8, utf8_decode('Período'),1,0,'C');
$pdf->Cell(20,8, utf8_decode('Desc.'),1,0,'C');
$pdf->Cell(35,8, utf8_decode('Importe'),1,1,'C');


///// estos son los ejemplos//////////////
///// estos son los ejemplos//////////////

$sqldetalle="SELECT * FROM op_detalles WHERE id_op=".$op;
$res=mysqli_query($link,$sqldetalle);
$total=0;
while($fila=mysqli_fetch_array($res)){
    
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(25,7, utf8_decode($fila['id_codigo']),1,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(90,7, utf8_decode($fila['detalle_codigo']),1,0,'L');
    $pdf->Cell(25,7, utf8_decode($fila['periodo']),1,0,'C');
    $pdf->Cell(20,7, utf8_decode($fila['descuento']),1,0,'C');
    $pdf->Cell(35,7, utf8_decode("$ ".$fila['importe']),1,1,'C');
    $total=$total+$fila['importe'];


}


//////////total//////////////////////////////////////
$pdf->SetFont('Arial','B',14);
$pdf->Cell(160,7, utf8_decode('TOTAL'),1,0,'R');
$pdf->Cell(35,7, utf8_decode("$ ".number_format($total,2,',','.')),1,1,'R');








//$pdf->Cell(95,8, utf8_decode('Constancia para Control'),1,0,'L');
////////////////////////////////constancia para socio ///////////////////////////
$pdf->SetXY(10,192);
$pdf->SetFont('Times','',12);
$pdf->Cell(15,7, utf8_decode('D.N.I:'),0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(30,7, utf8_decode($dni),0,0,'L'); 
$pdf->Cell(80,7, utf8_decode($apellido." ".$nombre),0,0,'L');

$pdf->SetFont('Helvetica','B',15);

$pdf->Cell(35,7, utf8_decode('OP: '.$op),0,0,'L');
$pdf->Cell(35,7, utf8_decode(formato_fecha_dd_mm_Y($fecha)),0,1,'R');


$pdf->SetFont('Times','',12);



$pdf->Cell(45,7, utf8_decode('Categoría:'),0,0,'L');
//$pdf->Cell(20,7, utf8_decode('Categoría:'),0,0,'L'); 
$pdf->SetFont('Times','B',12);
$pdf->Cell(70,7, utf8_decode($categoria),0,0,'L'); 
$pdf->Cell(80,7, utf8_decode('Constancia Para Control'),0,1,'R');
//$pdf->ln(3);
$pdf->SetFont('Times','',12);
//$pdf->Cell(5);


$pdf->SetFont('Times','B',15);
//$pdf->Cell(5);
$pdf->Cell(195,8, utf8_decode('Detalle de Pagos'),1,1,'C');
$pdf->SetFont('Arial','I',13);
//$pdf->Cell(30,5, utf8_decode('DNI'),1,0,'C');
$pdf->Cell(25,8, utf8_decode('Código'),1,0,'C');
$pdf->Cell(90,8, utf8_decode('Concepto'),1,0,'C');
//$pdf->Cell(30,5, utf8_decode('Categoría'),1,0,'C');
$pdf->Cell(25,8, utf8_decode('Período'),1,0,'C');
$pdf->Cell(20,8, utf8_decode('Desc.'),1,0,'C');
$pdf->Cell(35,8, utf8_decode('Importe'),1,1,'C');


///// estos son los ejemplos//////////////
///// estos son los ejemplos//////////////

$sqldetalle="SELECT * FROM op_detalles WHERE id_op=".$op;
$res=mysqli_query($link,$sqldetalle);
$total=0;
while($fila=mysqli_fetch_array($res)){
    
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(25,7, utf8_decode($fila['id_codigo']),1,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(90,7, utf8_decode($fila['detalle_codigo']),1,0,'L');
    $pdf->Cell(25,7, utf8_decode($fila['periodo']),1,0,'C');
    $pdf->Cell(20,7, utf8_decode($fila['descuento']),1,0,'C');
    $pdf->Cell(35,7, utf8_decode("$ ".$fila['importe']),1,1,'C');
    $total=$total+$fila['importe'];


}


//////////total//////////////////////////////////////
$pdf->SetFont('Arial','B',14);
$pdf->Cell(160,7, utf8_decode('TOTAL'),1,0,'R');
$pdf->Cell(35,7, utf8_decode("$ ".number_format($total,2,',','.')),1,1,'R');

//////////total//////////////////////////////////////

////////////////////////////////constancia para tesoreria/////////
$pdf->SetXY(10,264);
$pdf->SetFont('Times','',12);
$pdf->Cell(15,7, utf8_decode('D.N.I:'),0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(30,7, utf8_decode($dni),0,0,'L'); 
$pdf->Cell(80,7, utf8_decode($apellido." ".$nombre),0,0,'L');

$pdf->SetFont('Helvetica','B',15);

$pdf->Cell(35,7, utf8_decode('OP: '.$op),0,0,'L');
$pdf->Cell(35,7, utf8_decode(formato_fecha_dd_mm_Y($fecha)),0,1,'R');


$pdf->SetFont('Times','',12);



$pdf->Cell(45,7, utf8_decode('Categoría:'),0,0,'L');
//$pdf->Cell(20,7, utf8_decode('Categoría:'),0,0,'L'); 
$pdf->SetFont('Times','B',12);
$pdf->Cell(70,7, utf8_decode($categoria),0,0,'L'); 
$pdf->Cell(80,7, utf8_decode('Constancia Para Control'),0,1,'R');
//$pdf->ln(3);
$pdf->SetFont('Times','',12);
//$pdf->Cell(5);


//$pdf->SetFont('Helvetica','B',15);
//$pdf->Cell(80,10, utf8_decode('29/10/2019'),1,1,'R');

$pdf->SetFont('Times','B',15);
//$pdf->Cell(5);
$pdf->Cell(195,8, utf8_decode('Detalle de Pagos'),1,1,'C');
$pdf->SetFont('Arial','I',13);
//$pdf->Cell(30,5, utf8_decode('DNI'),1,0,'C');
$pdf->Cell(25,8, utf8_decode('Código'),1,0,'C');
$pdf->Cell(90,8, utf8_decode('Concepto'),1,0,'C');
//$pdf->Cell(30,5, utf8_decode('Categoría'),1,0,'C');
$pdf->Cell(25,8, utf8_decode('Período'),1,0,'C');
$pdf->Cell(20,8, utf8_decode('Desc.'),1,0,'C');
$pdf->Cell(35,8, utf8_decode('Importe'),1,1,'C');


///// estos son los ejemplos//////////////
///// estos son los ejemplos//////////////

$sqldetalle="SELECT * FROM op_detalles WHERE id_op=".$op;
$res=mysqli_query($link,$sqldetalle);
$total=0;
while($fila=mysqli_fetch_array($res)){
    
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(25,7, utf8_decode($fila['id_codigo']),1,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(90,7, utf8_decode($fila['detalle_codigo']),1,0,'L');
    $pdf->Cell(25,7, utf8_decode($fila['periodo']),1,0,'C');
    $pdf->Cell(20,7, utf8_decode($fila['descuento']),1,0,'C');
    $pdf->Cell(35,7, utf8_decode("$ ".$fila['importe']),1,1,'C');
    $total=$total+$fila['importe'];


}


//////////total//////////////////////////////////////
$pdf->SetFont('Arial','B',14);
$pdf->Cell(160,7, utf8_decode('TOTAL'),1,0,'R');
$pdf->Cell(35,7, utf8_decode("$ ".number_format($total,2,',','.')),1,1,'R');

//$pdf->SetFont('Times','',12);

//for($i=1;$i<=40;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
$pdf->Output();










?>
