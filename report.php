<?php

include("connect.php"); 	
	
	$link=Connection();
	
	$sth1 = $link->prepare("SELECT fecha_hora FROM medidor ORDER BY fecha_hora DESC LIMIT 1");
	$sth1->execute();
    
    $sth2 = $link->prepare("SELECT AVG(voltaje) as voltajeProm FROM medidor");
	$sth2->execute();
    
    $sth3 = $link->prepare("SELECT AVG(corriente) as corrienteProm FROM medidor");
	$sth3->execute();
    
    
    $sth4 = $link->prepare("SELECT AVG(energia) as energiaProm FROM medidor");
	$sth4->execute();
    
    $sth5 = $link->prepare("SELECT SUM(voltaje) as voltajeSum FROM medidor");
	$sth5->execute();
    
    $sth6 = $link->prepare("SELECT SUM(corriente) as corrienteSum FROM medidor");
	$sth6->execute();
    
    $sth7 = $link->prepare("SELECT SUM(energia) as energiaSum FROM medidor");
	$sth7->execute();
    
foreach($sth1->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$fecha = $row['fecha_hora'];	
endforeach;

foreach($sth2->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$volt = $row['voltajeProm'];	
endforeach;

foreach($sth3->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$corr = $row['corrienteProm'];	
endforeach;

foreach($sth4->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$energ = $row['energiaProm'];	
endforeach;


foreach($sth5->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$volt1 = $row['voltajeSum'];	
endforeach;

foreach($sth6->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$corr1 = $row['corrienteSum'];	
endforeach;

foreach($sth7->fetchAll(PDO::FETCH_ASSOC) as $row) :			
		$energ1 = $row['energiaSum'];	
endforeach;
require("fpdf/fpdf.php");
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",16);
    
    $pdf->Cell(100,10,"Fecha :",0,1);
    $pdf->Cell(90,10,$fecha,0,1);
    $pdf->Cell(90,10,"",0,1);
    
    $pdf->Cell(0,10,"Consumo Promedio Hasta la Fecha",1,1,C);

    $pdf->Cell(100,10,"Voltaje Prom (Volt) :",1,0);
    $pdf->Cell(90,10,$volt,1,1);
    $pdf->Cell(100,10,"Corriente Prom (Amper) :",1,0);
    $pdf->Cell(90,10,$corr,1,1);
    $pdf->Cell(100,10,"Energia Prom (Joul) :",1,0);
    $pdf->Cell(90,10,$energ,1,1);
    
    $pdf->Cell(0,10,"Consumo Acumulado Hasta la Fecha",1,1,C);
    $pdf->Cell(100,10,"Voltaje Acum (Volt) :",1,0);
    $pdf->Cell(90,10,$volt1,1,1);
    $pdf->Cell(100,10,"Corriente Acum (Amper) :",1,0);
    $pdf->Cell(90,10,$corr1,1,1);
    $pdf->Cell(100,10,"Energia Acum (Joul) :",1,0);
    $pdf->Cell(90,10,$energ1,1,1);
    $pdf->output();
?>