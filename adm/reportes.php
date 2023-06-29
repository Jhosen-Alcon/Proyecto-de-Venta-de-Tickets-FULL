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
    $this->Cell(100,8,'REPORTES DE USUARIOS',0,1,'C',0);
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

    $pdf->Cell(30,8, 'C.I','B',0,'C',0);
    $pdf->Cell(30,8, 'NOMBRE',1,0, 'C',0);
    $pdf->Cell(35,8, 'APELLIDO','B',0,'C',0);
    $pdf->Cell(35,8, 'FECHA NACIMIENTO','B',0,'C',0);
    $pdf->Cell(40,8, 'CORREO','B',1,'C',0);
   
    
    include('./conexion/conexionn.php');
    require('./conexion/conexionn.php');
    

    $consulta='SELECT*FROM usuario';
    $resultado=mysqli_query($conexion,$consulta);

    $pdf->SetTextColor(0,0,0);
    
    while($row=$resultado->fetch_assoc()){
    $pdf->SetFillColor(225, 68, 35);//color de fondo rgb
    $pdf->SetDrawColor(163, 134, 128);//color de linea  rgb
       $pdf->SetX(15);
      $pdf->Cell(30,8, $row['CI'], 'B',0,'C',0);
        $pdf->Cell(35,8, $row['Nombre_Usuario'],'B',0,'C',0);
        $pdf->Cell(35,8, $row['Apellido_Usuario'],'B',0,'C',0);
        $pdf->Cell(35,8, $row['Fecha_Nacimiento'],'B',0,'C',0);
        $pdf->Cell(40,8, $row['correo'],'B',1,'C',0);
    }
    $pdf->Output('reporte.pdf','D');
?>