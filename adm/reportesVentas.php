<?php
require('./pdf/fpdf.php');
include('./global/sesiones.php');


class PDF extends FPDF{


    //CABECER DE PAGINA
    function Header()
    {
    $this->SetFont('Times','B',20);
    $this->Image('images/triangulosrecortados.png',0,0,70); //imagen(archivo, png/jpg || x,y,tamaño)
    $this->setXY(60,15);
    $this->Cell(1000,8,'REPORTES DE VENTAS',0,1,'C',0);
    $this->Ln(7);
    $this->SetX(32);
    $this->Cell(0,0,'GREAT EVENTS',0,0,'C',0);
    $this->Image('images/logo.png',155,10,35); //imagen(archivo, png/jpg || x,y,tamaño)
    $this->Ln(40);

    }
    function Footer()
    {
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','B',10);
        // Número de página
        $this->Cell(170,10,'Todos los derechos reservados',0,0,'C',0);
        $this->Cell(25,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}
$pdf = new PDF();//hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage();//añade l apagina / en blanco
$pdf->SetMargins(10,10,10);

$pdf->SetAutoPageBreak(true,20);//salto de pagina automatico
$pdf->SetX(15);
$pdf->SetFont('Helvetica','B',10);
 
    
    


$pdf->Cell(10,8, 'ID Venta','B',0,'C',0);
$pdf->Cell(20,8, 'CI','B',0,'C',0);
$pdf->Cell(30,8, 'Nombre','B',0,'C',0);
$pdf->Cell(40,8, 'Apellido','B',0,'C',0);
$pdf->Cell(50,8, 'Nombre evento','B',0,'C',0);
$pdf->Cell(10,8, 'Cantidad','B',0,'C',0);
$pdf->Cell(30,8, 'Costo Total','B',1,'C',0);
   
    
    include('./conexion/conexionn.php');
    require('./conexion/conexionn.php');
    //require './conexion/conexion3.php';

    $consulta='SELECT * from detalle_venta de inner join cliente cl on de.IDLogin=cl.IDLogin inner join persona pe on pe.CI=cl.CI inner join boleto b on b.Id_Boleto=de.Id_Boleto 
    inner join evento ev on ev.Id_Evento=b.Id_Evento inner join lugar lu on lu.Id_Lugar=ev.Id_Lugar';
    $resultado=mysqli_query($conexion,$consulta);
    $resultados=$resultado->num_rows;
    
    
    //$objeto = new DB();
    //$conexion = $objeto->connect();
    //$consulta= 'SELECT * from usuario';
    //$resultado = $conexion->prepare($consulta);
    //$resultado->execute();
   // $test=$resultado->fetchAll(PDO::FETCH_ASSOC);
   //$rows=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
    $pdf->SetTextColor(0,0,0);
    while($row=$resultado->fetch_assoc()){
        $pdf->SetFillColor(225, 68, 35);//color de fondo rgb
        $pdf->SetDrawColor(163, 134, 128);//color de linea  rgb
           
           $pdf->SetX(15);
           $pdf->Cell(10,8, $row['NumeroVenta'], 'B',0,'C',0);
           $pdf->Cell(20,8, $row['CI'], 'B',0,'C',0);
           $pdf->Cell(30,8, $row['Nombre'], 'B',0,'C',0);
           $pdf->Cell(40,8, $row['Apeliido'], 'B',0,'C',0);
             $pdf->Cell(50,8, $row['Nombre_Evento'],'B',0,'C',0);
             $pdf->Cell(10,8, $row['Cantidad'],'B',0,'C',0);
             $pdf->Cell(30,8, $row['CostoTotal'],'B',1,'C',0);
        }
$pdf->Output('reporteventa.pdf','D');


?>