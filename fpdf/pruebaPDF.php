<?php
    require("../php/conexion.php");
    require("fpdf.php");

    class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {

        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(60,20,'Reporte Mayor Desplazamiento',0,0,'C');
        // Salto de línea
        $this->Ln(50);

        $this->Cell(5);
        $this->Cell(75, 10, 'Nombre Edificio', 0, 0, 'C', 0);
        $this->Cell(55, 10, 'Hora (hrs)', 0, 0, 'C', 0);
        $this->Cell(35, 10, 'Cant.registros', 0, 0, 'C', 0);
        $this->Ln(20);

    }
    
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-40);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(185, 10, utf8_decode('Proyecto N°5'), 0, 0, 'C', 0);
        $this->Ln(10);
        $this->Cell(185, 10, utf8_decode('
Universidad Católica de la Santísima Concepción'), 0, 0, 'C', 0);
        $this->Ln(10);
        $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
    }
    }

    /*sql*/
    $consulta = "SELECT  HOUR(fecha_entrada) as mayor_d, prueba_max,  id_edificio, nombre_edificio, fecha_entrada 
    FROM permanecer JOIN edificio USING(id_edificio) JOIN max_desplazamiento USING(id_edificio)
    GROUP BY prueba_max DESC;"; 
    $resultado = mysqli_query($conexion,$consulta);


    $pdf = new PDF();
    $pdf -> AliasNbPages();
    $pdf -> AddPAge();
    $pdf -> SetFont('Arial','',16);
    while($row = $resultado->fetch_Assoc()){
        $pdf->Cell(4);
        $pdf->Cell(80, 10, $row['nombre_edificio'], 1, 0, 'C', 0);
        $pdf->Cell(45, 10, $row['mayor_d'], 1, 0, 'C', 0);
        $pdf->Cell(45, 10, $row['prueba_max'], 1, 0, 'C', 0);
        $pdf->Ln(10);
    }


    $pdf -> Output();

?>